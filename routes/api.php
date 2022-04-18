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

Route::post('login','AuthController@login');
Route::post('register','AuthController@register');

//////////////// home
Route::get('slider','HomeController@slider');
Route::get('home','HomeController@home');

/////////////// posts
Route::get('posts/{type}','PostController@posts');
Route::get('onePost','PostController@onePost');

Route::fallback(function () {
    return helperJson(null,'URL NOT FOUND!',404);
});
