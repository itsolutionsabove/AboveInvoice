<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Product\ProductCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $request->header('LANG', null) == 'ar' ?  $this->name_ar : $this->name,
            'image' => url($this->image ? "uploads/categories/" . $this->image : "dist/img/no-thumb.jpg"),
            'products' => $this->whenLoaded('products', fn() => new ProductCollection($this->products))
        ];
    }
}
