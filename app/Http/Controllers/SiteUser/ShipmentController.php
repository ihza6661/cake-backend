<?php

namespace App\Http\Controllers\SiteUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\SiteUser\CalculateShippingCostRequest;
use Illuminate\Http\JsonResponse;

class ShipmentController extends Controller
{
    public function calculateShippingCost(CalculateShippingCostRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();

            $originPostalCode = env('POSTAL_CODE_ORIGIN');
            if (!$originPostalCode) {
                return response()->json(['message' => 'Konfigurasi asal pengiriman (kode pos) belum diatur.'], 500);
            }

            $apiKey = env('RAJA_ONGKIR_API_KEY');
            if (!$apiKey) {
                return response()->json(['message' => 'Konfigurasi API Key RajaOngkir belum diatur.'], 500);
            }

            $payload = [
                'origin' => $originPostalCode,
                'destination' => $validatedData['destination'],
                'weight' => $validatedData['weight'],
                'courier' => strtolower($validatedData['courier']),
            ];
            $payload = array_filter($payload, fn($value) => !is_null($value));

            $apiUrl = 'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost';

            $response = Http::asForm()
                ->withHeaders(['key' => $apiKey])
                ->post($apiUrl, $payload);

            Log::info('Komerce RajaOngkir Request:', ['url' => $apiUrl, 'payload_in_body' => $payload]);
            Log::info('Komerce RajaOngkir Response:', ['status' => $response->status(), 'body' => $response->body()]);

            $responseData = $response->json();

            if ($response->successful() && isset($responseData['data']) && is_array($responseData['data'])) {
                return response()->json($responseData['data'], 200);
            } else if ($response->successful() && isset($responseData['data']['costs']) && is_array($responseData['data']['costs'])) {
                return response()->json($responseData['data']['costs'], 200);
            } else {
                $errorMessage = $responseData['meta']['message'] ?? ($responseData['message'] ?? 'Gagal menghitung ongkos kirim.');
                Log::error('Komerce RajaOngkir API Error:', ['status' => $response->status(), 'description' => $errorMessage, 'payload_sent' => $payload]);
                return response()->json(['message' => $errorMessage], $response->status() >= 400 ? $response->status() : 400);
            }
        } catch (ConnectionException $e) {
            Log::error('Komerce RajaOngkir Connection Error:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Tidak dapat terhubung ke server penghitung ongkir.'], 503);
        } catch (\Exception $e) {
            Log::error('Error calculating shipping cost:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Terjadi kesalahan internal saat menghitung ongkos kirim.'], 500);
        }
    }
}
