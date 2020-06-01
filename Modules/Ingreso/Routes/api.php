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




Route::prefix('v1/ingreso')->middleware('auth:api')->group(function () {
    Route::prefix('ingresos')->group(function () {
        Route::get('/', 'IngresoAPIController@index')->name('ingreso.ingresos.index');
        Route::post('/', 'IngresoAPIController@store')->name('ingreso.ingresos.store');
        Route::put('/{id}', 'IngresoAPIController@update')->name('ingreso.ingresos.update');
        Route::delete('/{id}', 'IngresoAPIController@delete')->name('ingreso.ingresos.delete');
    });
});