<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function (){
    Route::post('register', 'Authentication\RegisterController@register');
});

//Route::middleware('auth:api')->group(function () {
Route::prefix('auth')->group(function (){
    Route::post('registser', 'Authentication\RegisterController@register');
});
Route::prefix('backoffice/store')->namespace('Backoffice\Store')->group(function (){
    Route::prefix('products')->group(function (){
        Route::get('', 'ProductController@index');
        Route::post('', 'ProductController@create');
        Route::put('{uuid}', 'ProductController@update');
        Route::delete('{uuid}', 'ProductController@delete');
    });
});
//});
