<?php

namespace App\Http\Resources\ProductRate;

use App\Http\Resources\Brand\BrandResource;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Event\EventCollection;
use App\Http\Resources\Type\TypeCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductRateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'user_name' => $this->user->name,
            'user_image' => url($this->user->image ? "uploads/users/" . $this->user->image : "dist/img/no-thumb.jpg"),
            'rate' => $this->rate,
            'comment' => $this->comment,
            'crated_at' => $this->created_at,
        ];
    }
}
