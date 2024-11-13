<?php

namespace App\Http\Resources\Settings;

use App\Http\Resources\Product\ProductCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    public function toArray($request)
    {

        // need return data  'key', 'value', 'type' from Settings model
        return [
            'id' => $this->id,
            'key' => $this->key,
            'value' => $this->value,
            'type' => $this->type,
        ];
    }
}
