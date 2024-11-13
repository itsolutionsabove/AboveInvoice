<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Brand\BrandResource;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\DailyValue\DailyValueCollection;
use App\Http\Resources\Event\EventCollection;
use App\Http\Resources\ProductRate\ProductRateCollection;
use App\Http\Resources\Type\TypeCollection;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        $in_wishlist = Auth::guard('api')->id() && WishList::where('user_id', Auth::guard('api')->id())->where('product_id', $this->id)->count();
        
        return [
            'id' => $this->id,
            'name' => $request->header('LANG', null) == 'ar' ?  $this->name_ar : $this->name,
            'default_image' => url($this->default_image ? "uploads/products/" . $this->default_image : "dist/img/no-thumb.jpg"),
            'images' => $this->images ? array_map(fn($i) => url("uploads/products/" . $i), json_decode($this->images)) : [],
            'story' => $request->header('LANG', null) == 'ar' ?  $this->story_ar : $this->story,
            'description' => $request->header('LANG', null) == 'ar' ?  $this->description_ar : $this->description,
            'default_price' => $this->default_price,
            'price_after_discount' => $this->price_after_discount,
            'discount' => $this->default_price ? round((($this->default_price - $this->price_after_discount) / $this->default_price) * 100) : 0,
            'default_rate' => $this->default_rate,
            'calories' => $this->calories,
            'serving_size' => $this->serving_size,
            'fact_detail' => $request->header('LANG', null) == 'ar' ?  $this->fact_detail_ar : $this->fact_detail,
            'visibility' => $this->visibility,
            'in_wishlist' => $in_wishlist,
            'daily_value' => $this->whenLoaded('dailyValue', fn() => new DailyValueCollection($this->dailyValue)),
            'categories' => $this->whenLoaded('categories', fn() => new CategoryCollection($this->categories)),
            'rates' => $this->whenLoaded('rates', fn() => new ProductRateCollection($this->rates)),
        ];
    }
}
