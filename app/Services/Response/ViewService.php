<?php

namespace App\Services\Response;

use App\AppInfo;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Factory;
use Illuminate\View\View;

class ViewService
{

    public static function show(string $view, array $data = [], $title = "Home"): View|Application|Factory
    {
        return view($view)->with(self::dataOrganizer($data, $title));
    }

    public static function dataOrganizer($data = [], $title = "Home"): array
    {
        // dd(AppInfo::dataWithView($title, $data));
        return ["global" => AppInfo::dataWithView($title, $data)];
    }

}