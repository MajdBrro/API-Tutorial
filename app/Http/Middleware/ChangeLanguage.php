<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {

        app() -> setLocale('ar');
        // if($request->header('lang') =='en'){
        if($request-> lang =='en'){

            app() -> setLocale('en');
        }


        return $next($request);
    }
}
