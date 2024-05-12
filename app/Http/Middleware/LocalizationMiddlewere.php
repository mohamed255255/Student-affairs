<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use MongoDB\Driver\Session;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Session::get("locale") != null){
            App::setLocale(Session::get("locale"));
        }else{
            session::put("locale" , "en");
            App:setlocale(Session::get("locale"));
        }
        return $next($request);
    }
}
