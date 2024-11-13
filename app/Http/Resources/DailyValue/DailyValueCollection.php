<?php

namespace App\Http\Resources\DailyValue;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DailyValueCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }

}
