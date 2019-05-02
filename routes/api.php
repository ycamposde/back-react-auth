<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
  Route::post('tokenyerson', 'HomeController@token');
  Route::resource('/home', 'HomeController');
});

Route::resource('/usuario', 'Api\UsuarioController');
Route::post('/usuario/login', 'Api\UsuarioController@login');
Route::post('/usuario/auth', 'Api\UsuarioController@auth');