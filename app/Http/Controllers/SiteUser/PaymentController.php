<?php

namespace App\Http\Controllers\SiteUser;

use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;
use App\Models\ShoppingCartItem;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiteUser\InitiatePaymentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->initMidtrans();
    }

    private function initMidtrans(): void
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
        Config::$overrideNotifUrl = env('NGROK_HTTP_8000');
    }

    public function initiatePayment(InitiatePaymentRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $cartItems = $validated['cartItems'];
        $addressId = $validated['address_id'];
        $shippingOption = $validated['shipping_option'];
        $shippingCost = (float) $shippingOption['cost'];
        $user = $request->user();
        $address = $user->addresses()->find($addressId);
        if (!$address) {
            return response()->json(['error' => 'Alamat pengiriman tidak valid.'], 400);
        }

        $order = null;
        $orderNumber = 'INV-' . strtoupper(Str::random(4)) . time();

        try {
            DB::beginTransaction();

            $itemSubtotal = 0;
            $preparedOrderItems = [];
            $midtransItemDetails = [];

            foreach ($cartItems as $item) {
                $product = Product::lockForUpdate()->find($item['product_id']);
                if (!$product) {
                    throw new \Exception('Produk ID ' . $item['product_id'] . ' tidak ditemukan.', 404);
                }
                if ($product->stock < $item['qty']) {
                    throw new \Exception("Stok {$product->product_name} tidak cukup (tersedia: {$product->stock}).", 422);
                }
                $price = $product->sale_price > 0 ? $product->sale_price : $product->original_price;
                $itemSubtotal += ($price * $item['qty']);
                $preparedOrderItems[] = ['product_id' => $product->id, 'qty' => $item['qty'], 'price' => $price];
                $midtransItemDetails[] = ['id' => (string)$product->id, 'price' => (float)$price, 'quantity' => (int)$item['qty'], 'name' => substr($product->product_name, 0, 50)];
            }

            $midtransItemDetails[] = ['id' => 'SHIPPING_' . $shippingOption['code'], 'price' => $shippingCost, 'quantity' => 1, 'name' => 'Ongkos Kirim (' . strtoupper($shippingOption['code']) . ' - ' . $shippingOption['service'] . ')'];
            $grandTotal = $itemSubtotal + $shippingCost;

            $order = Order::create([
                'site_user_id' => $user->id,
                'address_id' => $addressId,
                'order_number' => $orderNumber,
                'total_amount' => $itemSubtotal,
                'shipping_cost' => $shippingCost,
                'status' => OrderStatus::PENDING,
            ]);

            $order->orderItems()->createMany($preparedOrderItems);
            $order->shipment()->create(['courier' => $shippingOption['code'], 'service' => $shippingOption['service'], 'status' => 'pending']);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating order:', ['order_id_attempt' => $orderNumber, 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getCode() : (is_int($e->getCode()) && $e->getCode() >= 400 ? $e->getCode() : 500);
            $errorMessage = ($statusCode >= 400 && $statusCode < 500) ? $e->getMessage() : 'Terjadi kesalahan saat memproses pesanan.';
            return response()->json(['error' => $errorMessage], $statusCode);
        }

        try {
            $customerPhone = $address->phone_number ?? $user->phone_number ?? 'N/A';
            $customerDetails = [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $customerPhone,
                'billing_address' => ['first_name' => $address->recipient_name, 'phone' => $address->phone_number, 'address' => $address->address_line1, 'city' => $address->city, 'postal_code' => $address->postal_code, 'country_code' => 'IDN'],
                'shipping_address' => ['first_name' => $address->recipient_name, 'phone' => $address->phone_number, 'address' => $address->address_line1, 'city' => $address->city, 'postal_code' => $address->postal_code, 'country_code' => 'IDN']
            ];

            $frontendBaseUrl = config('app.frontend_url', env('FRONTEND_URL', 'http://localhost:5173'));

            $params = [
                'transaction_details' => ['order_id' => $orderNumber, 'gross_amount' => (float)$grandTotal],
                'customer_details' => $customerDetails,
                'item_details' => $midtransItemDetails,
                'finish' => $frontendBaseUrl . '/dashboard/pesanan/' . $order->id,
            ];

            $snapToken = Snap::getSnapToken($params);
            return response()->json([
                'snapToken' => $snapToken,
                'order_number' => $orderNumber,
                'order_db_id' => $order->id
            ]);
        } catch (\Exception $e) {
            Log::error('Error generating Midtrans Snap Token:', ['order_id' => $orderNumber, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Gagal memulai sesi pembayaran.'], 500);
        }
    }

    public function handleNotification(Request $request): JsonResponse
    {
        Log::info('Midtrans Notification Received:', $request->all());

        try {
            $notification = new Notification();

            $transactionStatus = $notification->transaction_status;
            $transactionId = $notification->transaction_id;
            $orderId = $notification->order_id;
            $fraudStatus = $notification->fraud_status ?? null;
            $paymentType = $notification->payment_type;
            $grossAmount = $notification->gross_amount;

            $order = Order::with('orderItems')->where('order_number', $orderId)->first();

            if (!$order) {
                Log::warning('Midtrans Notification: Order not found.', ['order_id' => $orderId]);
                return response()->json(['message' => 'Pesanan tidak ditemukan.'], 404);
            }

            DB::beginTransaction();

            Payment::updateOrCreate(
                ['order_id' => $order->id,],
                [
                    'transaction_id' => $transactionId,
                    'payment_type' => $paymentType,
                    'status' => $transactionStatus == 'expire' ? 'expired' : $transactionStatus,
                    'amount' => $grossAmount,
                    'metadata' => json_encode($notification->getResponse()),
                ]
            );

            $previousStatusEnum = $order->status;
            $newOrderStatusEnum = $previousStatusEnum;

            if (!in_array($previousStatusEnum, [OrderStatus::DELIVERED, OrderStatus::CANCELLED])) {
                if ($transactionStatus == 'capture') {
                    if ($fraudStatus == 'accept') {
                        $newOrderStatusEnum = OrderStatus::PAID;
                    } else if ($fraudStatus == 'challenge') {
                        $newOrderStatusEnum = OrderStatus::PENDING;
                    } else {
                        $newOrderStatusEnum = OrderStatus::CANCELLED;
                    }
                } else if ($transactionStatus == 'settlement') {
                    $newOrderStatusEnum = OrderStatus::PAID;
                } else if ($transactionStatus == 'pending') {
                    if ($previousStatusEnum !== OrderStatus::PAID) {
                        $newOrderStatusEnum = OrderStatus::PENDING;
                    }
                } else if (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                    if (!in_array($previousStatusEnum, [OrderStatus::PAID, OrderStatus::DELIVERED])) {
                        $newOrderStatusEnum = OrderStatus::CANCELLED;
                    }
                }
            }

            if ($newOrderStatusEnum === OrderStatus::PAID && $previousStatusEnum === OrderStatus::PENDING) {
                Log::info('Payment successful, decrementing stock.', ['order_id' => $order->id]);
                foreach ($order->orderItems as $orderItem) {
                    $product = Product::lockForUpdate()->find($orderItem->product_id);
                    if ($product) {
                        if ($product->stock >= $orderItem->qty) {
                            $product->decrement('stock', $orderItem->qty);
                        } else {
                            Log::error('Insufficient stock during notification handling.', ['order_id' => $order->id, 'product_id' => $product->id, 'required' => $orderItem->qty, 'available' => $product->stock]);
                        }
                    }
                }

                ShoppingCartItem::whereHas('shoppingCart', fn($q) => $q->where('site_user_id', $order->site_user_id))->delete();
            } else if ($newOrderStatusEnum === OrderStatus::CANCELLED && $previousStatusEnum !== OrderStatus::CANCELLED) {
                Log::info('Order cancelled, restoring stock.', ['order_id' => $order->id]);
                foreach ($order->orderItems as $orderItem) {
                    $product = Product::find($orderItem->product_id);
                    if ($product) {
                        $product->increment('stock', $orderItem->qty);
                    }
                }
            }

            if ($newOrderStatusEnum !== $previousStatusEnum) {
                $order->update(['status' => $newOrderStatusEnum]);
                Log::info('Order status updated.', ['order_id' => $order->id, 'from' => $previousStatusEnum->value, 'to' => $newOrderStatusEnum->value]);
            } else {
                Log::info('Order status unchanged.', ['order_id' => $order->id, 'status' => $previousStatusEnum->value]);
            }

            DB::commit();
            Log::info('Midtrans notification processed successfully.', ['order_id' => $order->id]);
            return response()->json(['message' => 'Notifikasi berhasil diproses.']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error processing Midtrans notification:', ['order_id' => $notification->order_id ?? ($orderId ?? 'N/A'), 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Terjadi kesalahan internal server saat proses notifikasi.'], 500);
        }
    }
}
