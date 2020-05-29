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



    Route::prefix('usuarios')->group(function (){
        Route::get('/', 'UserAPIController@index')->name('usuario.usuarios.index');
        Route::post('/', 'UserAPIController@store')->name('usuario.usuarios.store');
        Route::put('/{id}', 'UserAPIController@update')->name('usuario.usuarios.update');
        Route::delete('/{id}', 'UserAPIController@delete')->name('usuario.usuarios.delete');
    });

    Route::prefix('clientes_negocios')->group(function (){
        Route::get('/', 'ClienteNegocioAPIController@index')->name('usuario.clientes_negocios.index');
        Route::get('/{id}', 'ClienteNegocioAPIController@show')->name('usuario.clientes_negocios.show');
        Route::post('/', 'ClienteNegocioAPIController@store')->name('usuario.clientes_negocios.store');
        Route::put('/{id}', 'ClienteNegocioAPIController@update')->name('usuario.clientes_negocios.update');
        Route::delete('/{id}', 'ClienteNegocioAPIController@delete')->name('usuario.clientes_negocios.delete');
    });
});




