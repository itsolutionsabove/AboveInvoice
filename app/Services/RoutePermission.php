<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;

class RoutePermission
{

    private static array $replacements = [
        "list" => ["show", "index", "showAll"],
        "delete" => ["destroy", "destroyTranslate"],
        "store" => ["createTranslation"],
        "update" => ["updateTranslate"]
    ];

    public static function check($user) : bool
    {
        try {
            $target = explode("\\", Route::currentRouteAction());
            $permission = strtolower(str_replace("Controller@", ".", end($target)));
            $permission = self::replaceUnknownPermissions(self::camelToSnake($permission));

            return $user->can($permission);
        }catch (\Exception $ex){
            return false;
        }
    }

    public static function replaceUnknownPermissions($permission)
    {
        foreach (self::$replacements as $replace => $search)
            $permission = str_replace($search, $replace, $permission);
        return $permission;
    }

    public static function camelToSnake($input): string
    {
        $result = preg_replace_callback('/([a-z])([A-Z])/', function ($matches) {
            return $matches[1] . '_' . strtolower($matches[2]);
        }, $input);

        return strtolower($result);
    }

}
