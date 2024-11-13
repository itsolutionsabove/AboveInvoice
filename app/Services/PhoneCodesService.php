<?php

namespace App\Services;

class PhoneCodesService
{

    private static array $codes = [];

    public static function getCountriesCodes(): array
    {
        if(count(self::$codes)) return self::$codes;
        try{
            return self::$codes = json_decode(file_get_contents(resource_path('JSON/countries_codes.json')), true);
        }catch (\Exception $ex){
            return [];
        }
    }

}
