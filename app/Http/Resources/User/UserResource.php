<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Product\ProductCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            // 'thumb' => url($this->thumb ? "uploads/" . $this->thumb : "dist/img/no-thumb.jpg"),
            'image' => url($this->image ? "uploads/users/" . $this->image : "dist/img/no-thumb.jpg"),
            'phone' => $this->phone,
            'country_code' => $this->country_code,
            'gender' => $this->gender,
            'created_at' => $this->created_at?->format('Y-m-d h:i a'),
            'subscribed' => $this->subscription ? true : false,
        ];
    }
}
