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

Route::prefix('v1/venta')->middleware('auth:api')->group(function () {
    Route::prefix('ventas')->group(function () {
        Route::get('/', 'VentaAPIController@index')->name('venta.ventas.index');
        Route::post('/', 'VentaAPIController@store')->name('venta.ventas.store');
        Route::put('/{id}', 'VentaAPIController@update')->name('venta.ventas.update');
        Route::get('/{id}', 'VentaAPIController@show')->name('venta.ventas.show');
        Route::delete('/{id}', 'VentaAPIController@destroy')->name('venta.ventas.delete');
    });
});


Route::prefix('v1/venta')->middleware('auth:api')->group(function () {
    Route::prefix('motivo_ventas')->group(function () {
        Route::get('/', 'MotivoVentaAPIController@index')->name('venta.motivo_ventas.index');
        Route::post('/', 'MotivoVentaAPIController@store')->name('venta.motivo_ventas.store');
        Route::put('/{id}', 'MotivoVentaAPIController@update')->name('venta.motivo_ventas.update');
        Route::delete('/{id}', 'MotivoVentaAPIController@destroy')->name('venta.motivo_ventas.delete');
    });
});
