<?php

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

Route::prefix('v1/condicion_corporal')->middleware('auth:api')->group(function () {
    Route::prefix('/condiciones_corporales')->group(function () {
        Route::get('/', 'CondicionCorporalAPIController@index')->name('condicion_coporal.condiciones_corporales.index');
        Route::post('/', 'CondicionCorporalAPIController@store')->name('condicion_coporal.condiciones_corporales.store');
        Route::put('/{id}', 'CondicionCorporalAPIController@update')->name('condicion_coporal.condiciones_corporales.update');
        Route::delete('/{id}', 'CondicionCorporalAPIController@destroy')->name('condicion_coporal.condiciones_corporales.destroy');
    });
});
