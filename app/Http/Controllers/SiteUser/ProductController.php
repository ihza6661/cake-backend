<?php

namespace App\Http\Controllers\SiteUser;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiteUser\CategoryResource;
use App\Http\Resources\SiteUser\ProductResource;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function getAllCategories(): AnonymousResourceCollection
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    public function getAllProducts(Request $request): AnonymousResourceCollection
    {
        $query = Product::with(['images', 'category']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $searchTerms = explode(' ', $request->search);
            $query->where(function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $term = '%' . $term . '%';
                    $q->where(function ($q2) use ($term) {
                        $q2->where('product_name', 'like', $term)
                            ->orWhere('description', 'like', $term)
                            ->orWhereHas('category', function ($cq) use ($term) {
                                $cq->where('category_name', 'like', $term);
                            });
                    });
                }
            });
        }

        $sortBy = $request->input('sort_by', 'created_at');
        $sortDir = $request->input('sort_dir', 'desc');

        $allowedSortColumns = ['created_at', 'product_name', 'original_price'];
        $allowedSortDirections = ['asc', 'desc'];

        if (in_array($sortBy, $allowedSortColumns) && in_array(strtolower($sortDir), $allowedSortDirections)) {

            if ($sortBy === 'original_price') {
                $query->orderByRaw("
                    CAST(
                        (CASE
                            WHEN sale_price IS NOT NULL AND sale_price > 0 THEN sale_price
                            ELSE original_price
                        END)
                    AS DECIMAL(15, 2))
                 $sortDir");
            } else {
                $query->orderBy($sortBy, $sortDir);
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $query->orderByRaw('stock > 0 DESC');

        $query->orderBy('id', 'desc');

        $perPage = $request->input('per_page', 12);
        $products = $query->paginate($perPage);

        $products->appends($request->except('page'));

        return ProductResource::collection($products);
    }

    public function getLatestProducts(): AnonymousResourceCollection
    {
        $products = Product::with(['images', 'category'])
            ->where('stock', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        return ProductResource::collection($products);
    }

    public function getProductDetail(Product $product): ProductResource|JsonResponse
    {
        $product->loadMissing('images', 'category');

        return new ProductResource($product);
    }

    public function getRelatedProducts(Request $request): AnonymousResourceCollection|JsonResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'product_id' => 'sometimes|integer|exists:products,id'
        ]);

        $categoryId = $validated['category_id'];
        $productId = $validated['product_id'] ?? null;

        $query = Product::where('category_id', $categoryId)
            ->where('stock', '>', 0);

        if ($productId) {
            $query->where('id', '<>', $productId);
        }

        $relatedProducts = $query->with([
            'images' => function ($q) {
                $q->where('is_primary', true)->orWhere(function ($q2) {
                    $q2->limit(1);
                });
            }
        ])
            ->inRandomOrder()
            ->take(4)
            ->get();

        return ProductResource::collection($relatedProducts);
    }
}
