<?php

namespace App\Http\Resources\DailyValue;

use App\Http\Resources\Product\ProductCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyValueResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $request->header('LANG', null) == 'ar' ?  $this->title_ar : $this->title,
            'description' => $request->header('LANG', null) == 'ar' ?  $this->description_ar : $this->description,
            'value' => $this->value,
        ];
    }
}
