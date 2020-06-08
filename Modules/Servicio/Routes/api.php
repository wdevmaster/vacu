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

Route::prefix('v1/servicio')->middleware('auth:api')->group(function () {
    Route::prefix('servicios')->group(function () {
        Route::get('/', 'RolBotonAPIController@index')->name('servicio.servicios.index');
        Route::post('/', 'RolBotonAPIController@store')->name('servicio.servicios.store');
        Route::put('/{id}', 'RolBotonAPIController@update')->name('servicio.servicios.update');
        Route::delete('/{id}', 'RolBotonAPIController@destroy')->name('servicio.servicios.delete');
    });
});

