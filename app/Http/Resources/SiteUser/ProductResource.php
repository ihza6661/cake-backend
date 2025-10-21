<?php

namespace App\Http\Resources\SiteUser;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $effectivePrice = ($this->sale_price > 0) ? $this->sale_price : $this->original_price;

        return [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'slug' => $this->slug,
            'original_price' => $this->original_price,
            'sale_price' => $this->sale_price,
            'effective_price' => $effectivePrice,
            'stock' => $this->stock,
            'weight' => $this->weight,
            'label' => $this->label,
            'description' => $this->description,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'images' => ProductImageResource::collection($this->whenLoaded('images')),

            'primary_image' => new ProductImageResource($this->whenLoaded('images', function () {
                return $this->images->firstWhere('is_primary', true) ?? $this->images->first();
            })),

            'primary_image_url' => $this->whenLoaded('images', function () {
                $primary = $this->images->firstWhere('is_primary', true) ?? $this->images->first();
                return $primary ? url('storage/products/' . $primary->image) : null;
            }),
        ];
    }
}
