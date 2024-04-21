<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    use GeneralTrait;

    public function login(Request $request)
    {

        try {
            $rules = [
                "email" => "required",
                "password" => "required",

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('admin-api')->attempt($credentials);

            if (!$token){
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');
            }elseif($token){
            // return $this-> returnData('admin token number',$token,'تم الدخول بنجاح');// return just the Token
            $admin = Auth::guard('admin-api')->user();
            $admin->api_token = $token; //return token with all of the information of the user logged in now at the moment
            // ($admin وقد أصبحت كل هذه المعلومات ضمن الريكورد )
            // ( admins : Table أنشأته في  api_token وقد وضعت التوكين ضمن حقل جديد )
            return $this->returnData('admin', $admin,'تم الدخول بنجاوهذه معلومات الحاب مع التوكين');
            }

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function logout(Request $request)
    {
    ##############################################################################
    // $token = $request -> header('auth-token');
    // // $token = $request->only(['auth-token']);
    // if($token){
        //     JWTAuth::setToken($token)->invalidate();
        //     return $this->returnSuccessMessage('Logged out successfully');
        // }else{
            //     return  $this -> returnError('E3543','there is no token');
            // }

    ##############################################################################
    $token = $request -> header('auth-token');
    // $token = $request->only(['auth-token']);
    if($token){
        try {

            JWTAuth::setToken($token)->invalidate(); //logout
        }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
            return  $this -> returnError('E3242','TokenInvalidException');
        }
        return $this->returnSuccessMessage('Logged out successfully');
    }else{
        $this -> returnError('','some thing went wrongs');
    }
    ##############################################################################
        // $token = $request -> header('auth-token');
        // // $token = $request->only(['auth-token']);
        // if($token){
        //     try {

        //         JWTAuth::setToken($token)->invalidate(); //logout
        //     }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
        //         return  $this -> returnError('403','TokenInvalidException');
        //     }catch (\Tymon\JWTAuth\Exceptions\TokenBlacklistedException $e){
        //         return  $this -> returnError('404','TokenBlacklistedException');
        //     }catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
        //         return  $this -> returnError('405','TokenExpiredException');
        //     }
        //     return $this->returnSuccessMessage('Logged out successfully');
        // }else{
        //     $this -> returnError('406','some thing went wrongs');
        // }

    }
}
