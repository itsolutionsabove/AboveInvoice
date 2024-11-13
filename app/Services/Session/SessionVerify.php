<?php

namespace App\Services\Session;

class SessionVerify
{

    public static function sessionChecker(): void
    {
        if(session_status() === PHP_SESSION_NONE) session_start();
    }

    public static function put($key, $value): void
    {
        self::sessionChecker();
        $_SESSION[$key] = $value;
    }

    public static function unset($key): void
    {
        self::sessionChecker();
        if(isset($_SESSION[$key])){
            $_SESSION[$key] = "";
            unset($_SESSION[$key]);
        }
    }

    public static function get($key): mixed
    {
        self::sessionChecker();
        return $_SESSION[$key] ?? false;
    }

}
