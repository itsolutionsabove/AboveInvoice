<?php

namespace App\Services;

class PricesService
{

    public static function getSearchPrices(): array
    {
        return [
            '500',
            '1000',
            '1500',
            '2000'
        ];
    }

}
