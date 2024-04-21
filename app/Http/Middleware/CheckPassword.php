<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $password='12345678';
        // if ($request->header('api_password') != $password) {
        if ($request-> api_password != $password) {
        // if ($request->header('api_password') == env('API_PASSWORD')) {
            return response()->json(['message'=> 'Unauthenticated']);
        }elseif($request-> api_password == $password){
            return $next($request);
        }
    }
}
