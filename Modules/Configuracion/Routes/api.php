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

Route::prefix('v1/configuracion')->middleware('auth:api')->group(function(){

    Route::prefix('configuraciones')->group(function () {
        Route::get('/', 'ConfiguracionAPIController@index')->name('configuracion.index');
        Route::post('/', 'ConfiguracionAPIController@store')->name('configuracion.store');
        Route::put('/{id}', 'ConfiguracionAPIController@update')->name('configuracion.update');
        Route::delete('/{id}', 'ConfiguracionAPIController@destroy')->name('configuracion.delete');
    });

});
