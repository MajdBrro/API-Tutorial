<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckAdminToken
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user =null;
        try{
            $user = JWTAuth::parseToken()-> authenticate();
        }catch(\Exception $e){
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                // return response()->json(['success' => false, 'msg' => 'INVALID_TOKEN'], 200);
                return $this -> returnError("INVALID_TOKEN","234");
            }elseif($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                // return response()->json(['success' => false, 'msg' => 'EXPIRED_TOKEN'], 200);
                return $this -> returnError("EXPIRED_TOKEN","234");
            }else{
                // return response()->json(['success' => false, 'msg' => 'TOKEN_NOTFOUND'], 200);
                return $this -> returnError("TOKEN_NOTFOUND","234");
            }
            }
            catch(\Throwable $e){
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                    // return response()->json(['success' => false, 'msg' => 'INVALID_TOKEN'], 200);
                    return $this -> returnError("INVALID_TOKEN","234");

                }elseif($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                    // return response()->json(['success' => false, 'msg' => 'EXPIRED_TOKEN'], 200);
                    return $this -> returnError("EXPIRED_TOKEN","234");

                }else{
                    // return response()->json(['success' => false, 'msg' => 'TOKEN_NOTFOUND'], 200);
                    return $this -> returnError("TOKEN_NOTFOUND","234");

                }
            }
            if(!$user)
                // return response()->json(['success' => false, 'msg' => trans('Unauthenticated')], 200);
                return $this-> returnError('E331',trans('Unauthenticated'));
        return $next($request);
    }
}
