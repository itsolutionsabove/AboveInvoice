<?php

namespace App;

use App\Models\Settings;
use App\Services\ModelsDataHandler\ViewElementsService;

class AppInfo
{

    public static array $elements;
    public static array $daysOfWeek = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
    ];

    public static function dataWithView($title = "Home", $viewData = []): object
    {
        $object["page"] = self::getPageDetails($title);
        $object["meta"] = self::getMetaDetails();
        $object["info"] = self::getInfoDetails();
        $object["data"] = (object) $viewData;
        self::$elements = $object;
        $object["VEService"] = new ViewElementsService();
        $object["AppInfo"] = new self;
        return (object) $object;
    }

    private static function getMetaDetails(): object
    {
        return (object) [
            "description" => "",
            "keywords" => "",
            "author" => "",
            "viewport" => "",
            "icon" => "assets/img/logo.svg"
        ];
    }

    private static function getPageDetails($title): object
    {
        $logo = Settings::where('key', 'Site Logo')->first();
        $logo = $logo ? url('uploads/' . $logo->value) : 'static/logo.svg';

        $name = Settings::where('key', 'Site Name')->first();
        $name = $name ? $name->value : 'Lenore';

        return (object) [
            "title" => $title,
            "app_name" => $name,
            "logo_url" => $logo,
            "elements" => self::elements()
        ];
    }

    private static function getInfoDetails(): object
    {
        $now = now();
        return (object) [
            "current_year" => $now->format('Y'),
            "current_month" => $now->format('m'),
            "current_day" => $now->format('d'),
            "days_of_week" => self::$daysOfWeek,
            "carbon" => $now,
            "copyrights" => "copyrights",
        ];
    }

    public static function elements(): object
    {
        return (object) [
            "form" => [
                "class" => "",
                "input" => [
                    "class" => "form-control"
                ],
                "label" => [
                    "class" => "form-label"
                ]
            ],
            "table" => [
                "class" => "table align-items-center mb-0 api-loader",
                "parent_dev" => [
                    "class" => "table-responsive p-0"
                ],
                "show" => [
                    "class" => "btn btn-outline-primary act-btn",
                ],
                "delete" => [
                    "class" => "btn btn-outline-danger apply-delete act-btn",
                ],
                "order" => [
                    "class" => "btn apply-patch act-btn",
                ]
            ],
            "preloader" => url('assets/img/loader.gif')
        ];
    }

    public function toJSString($mixed = null): ?string
    {
        if(!$mixed) $mixed = self::$elements;
        $mixed = (array) $mixed;
        return json_encode($mixed, true);
    }

    public static function permissions(): array
    {
        return [

            'User add',
            'User edit',
            'User update',
            'User delete',

            
            // 'Order review',
            // 'Order cancel',
            // 'Order update',

            // 'Notifications receive',
            'Settings update',

            // 'Client',

        ];
    }

    public static function settings(): array
    {
        return [
            ['key' => 'country_Jordan', 'type' => 'text' , 'value' => 'Jordan'],
            ['key' => 'address_Jordan', 'type' => 'text' , 'value' => 'Amman'],
            ['key' => 'tax number_Jordan', 'type' => 'text', 'value' => '123456'],
            ['key' => 'phone_Jordan', 'type' => 'text', 'value' => '0791234567'],
            ['key' => 'currency_Jordan', 'type' => 'text' , 'value' => 'JOD'],

            ['key' => 'country_saudi', 'type' => 'text' , 'value' => 'Saudi Arabia'],
            ['key' => 'address_saudi', 'type' => 'text' , 'value' => 'Riyadh'],
            ['key' => 'tax number_saudi', 'type' => 'text', 'value' => '123456'],
            ['key' => 'phone_saudi', 'type' => 'text', 'value' => '0591234567'],
            ['key' => 'currency_saudi', 'type' => 'text' , 'value' => 'SAR'],


//            ['key' => 'Site Name', 'type' => 'text'],
//            ['key' => 'Site Logo', 'type' => 'file'],
//            ['key' => 'Facebook_link' , 'type'=> 'text'],
//            ['key' => 'Instagram_link' , 'type'=> 'text'],
//            ['key' => 'WhatsApp_link' , 'type'=> 'text'],
//            ['key' => 'Phone' , 'type'=> 'text'],
        ];
    }

}
