<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

#################### all API's here must be API authenticated ########################
Route::group(['middleware'=>[/*'checkpassword',*/'checklanguage'],'namespace'=>'App\Http\Controllers\Api'],function(){

    Route::get('get-main-categories','CategoriesController@index');
    Route::get('get-category-byId','CategoriesController@getCategoryById');
    Route::get('change-category-status','CategoriesController@changeStatus');
    Route::get('cat','CategoriesController@cat');
    Route::get('test','CategoriesController@htmll');


    Route::group(['prefix' => 'admin','namespace'=>'Admin'],function (){
        Route::get('login', 'AuthController@login');
        Route::get('logout','AuthController@logout') -> middleware(['auth.guard:admin-api']);
    });
    Route::group(['prefix' => 'user','namespace'=>'User'],function (){
        Route::get('login', 'AuthController@login');
        Route::get('logout','AuthController@logout') -> middleware(['auth.guard:user-api']);
    });

    Route::group(['prefix' => 'user' ,'middleware' => 'auth.guard:user-api'],function (){
        Route::get('user-profile',function(){
            // return 'only authenticated user can reach me';
            return  Auth::user(); // return authenticated user data
        }) ;
    });
    Route::group(['prefix' => 'admin' ,'middleware' => 'auth.guard:admin-api'],function (){
        Route::get('admin-profile',function(){
            // return 'only authenticated user can reach me';
            return  Auth::user(); // return authenticated admin data
        }) ;
    });

});
    Route::group(['middleware'=>['checkpassword','checklanguage','checkAdminToken:admin-api'],'namespace'=>'App\Http\Controllers\Api'],function(){

        Route::get('offers','CategoriesController@index');

    });

// Route::group(['namespace'=>'App\Http\Controllers\Api'],function(){

//     Route::get('test','TestsController@htmll');

// });
#################### all API's here must be API authenticated ########################
