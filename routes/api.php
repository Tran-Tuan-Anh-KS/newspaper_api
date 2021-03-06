<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login','Api\Admin\LoginController@login');
// Route::post('/register', 'RegisterController@register');
// Route::post('/logout', 'LoginController@logout')->middleware('auth:api');

Route::group(['prefix' => '', 'namespace' => 'Api\Admin'], function () {
    // Route::get('/categories', 'CategoryController@index');
    // Route::resource('categories', 'CategoryController')->except('create','show');
    Route::resource('categories', 'CategoryController');
});
