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

Route::prefix('v1/tipo_servicio')->middleware('auth:api')->group(function () {
    Route::prefix('tipos_servicios')->group(function () {
        Route::get('/', 'TipoServicioAPIController@index')->name('tipo_servicio.tipos_servicios.index');
        Route::post('/', 'TipoServicioAPIController@store')->name('tipo_servicio.tipos_servicios.store');
        Route::put('/{id}', 'TipoServicioAPIController@update')->name('tipo_servicio.tipos_servicios.update');
        Route::delete('/{id}', 'TipoServicioAPIController@destroy')->name('tipo_servicio.tipos_servicios.delete');
    });
});
