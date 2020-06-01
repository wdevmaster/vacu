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
        Route::delete('/{id}', 'VentaAPIController@delete')->name('venta.ventas.delete');
    });
});
