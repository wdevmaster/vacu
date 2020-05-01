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

Route::prefix('v1/usuario')->group(function(){
    Route::post('/auth/register', 'Auth\RegisterController@register')->name('auth.register');
    Route::post('/auth/login', 'Auth\LoginController@login')->name('auth.login');


    Route::post('/auth/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('/auth/password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');

    Route::get('/auth/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::get('/auth/email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
});

Route::prefix('v1/usuario')->group(function(){

    Route::prefix('/usuarios')->group(function(){
        Route::get('/', 'UserAPIController@index')->name('user.users.index');
        Route::get('/{id}', 'UserAPIController@show')->name('user.users.show');
        Route::get('/filter/all', 'UserAPIController@filter')->name('user.users.filter');
        Route::post('/', 'UserAPIController@store')->name('user.users.store');
        Route::put('/{id}', 'UserAPIController@update')->name('user.users.update');
        Route::delete('/{id}', 'UserAPIController@destroy')->name('user.users.destroy');

    });

//    Route::prefix('/roles')->group(function(){
//        Route::get('/', 'RolController@index')->name('user.roles.index');
//    });
});
