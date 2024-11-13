<?php

namespace App\Http\Resources\Subscription;

use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $request->header('LANG', null) == 'ar' ?  $this->title_ar : $this->title,
            'count' => $this->count,
            'image' => url($this->image ? "uploads/subscriptions/" . $this->image : "dist/img/no-thumb.jpg"),
            'default_price' => $this->default_price,
            'price_after_discount' => $this->price_after_discount,
            'description' => $request->header('LANG', null) == 'ar' ?  $this->description_ar : $this->description,
            'discount' => $this->default_price ? round((($this->default_price - $this->price_after_discount) / $this->default_price) * 100) : 0,
        ];
    }
}
