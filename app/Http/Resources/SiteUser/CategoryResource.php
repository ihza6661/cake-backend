<?php

namespace App\Http\Resources\SiteUser;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_name' => $this->category_name,
            'image' => $this->image ? url('storage/' . $this->image) : null,
        ];
    }
}
