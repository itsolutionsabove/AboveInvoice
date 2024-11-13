<?php

namespace App\Http\Resources\Opinion;

use App\Http\Resources\Product\ProductCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class OpinionResource extends JsonResource
{
    public function toArray($request)
    {
        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'rate' => $this->rate,
            'comment' => $this->comment,
            'comment_ar' => $this->comment_ar,
            'image' => url($this->image ? "uploads/opinions/" . $this->image : "dist/img/no-thumb.jpg"),
        ];
    }
}
