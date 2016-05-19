<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//
Route::get('/', function () {
    return view('index');
});

Route::auth();

Route::get('api/v1/login',['uses' => 'Auth\AuthController@checkLogin']);
Route::post('api/v1/login',['uses' => 'Auth\AuthController@postAuthenticate']);
Route::get('api/v1/logout',['uses'=> 'Auth\AuthController@logout']);

Route::post('api/v1/hour', ['middleware' => 'auth', 'uses' => 'HourController@store']);
Route::get('api/v1/hour', ['middleware' => 'auth', 'uses' => 'HourController@index']);


