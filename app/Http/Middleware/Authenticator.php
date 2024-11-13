<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

class Authenticator
{
    public function handle($request, $next)
    {
        if(!in_array($request->route()->getName(), ["login", "api_login"]) && !Auth::check()){
            return redirect('login');
        }
        return $next($request);
    }
}
