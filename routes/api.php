<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->namespace('Authentication')->group(function (){
    Route::post('register', 'RegisterController@register');
    Route::post('login', 'LoginController@login');
});

Route::middleware('auth:api')->group(function (){
    Route::prefix('auth')->namespace('Authentication')->group(function (){
        Route::get('logout', 'LoginController@logout');
    });
    Route::prefix('backoffice/store')->namespace('Backoffice\Store')->group(function (){
        Route::prefix('products')->group(function (){
            Route::get('', 'ProductController@index');
            Route::post('', 'ProductController@create');
            Route::put('{uuid}', 'ProductController@update');
            Route::delete('{uuid}', 'ProductController@delete');
        });
    });
});
