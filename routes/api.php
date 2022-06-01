<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonsController;


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
Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/recover', 'App\Http\Controllers\AuthController@recover');
Route::resource('/persons', 'App\Http\Controllers\PersonsController')->except(['create','edit']);

Route::group(['middleware' => 'auth.jwt'], function () {
Route::post('/logout', 'App\Http\Controllers\AuthController@logout');

Route::get('/test', function(){
    return response()->json(['foo'=> 'bar']);
 });

 Route::get('/categories/select', 'CategoriesController@select');

});
