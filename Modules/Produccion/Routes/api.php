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

Route::prefix('v1/produccion')->middleware('auth:api')->group(function () {
    Route::prefix('producciones')->group(function () {
        Route::get('/', 'ProduccionAPIController@index')->name('produccion.producciones.index');
        Route::post('/', 'ProduccionAPIController@store')->name('produccion.producciones.store');
        Route::put('/{id}', 'ProduccionAPIController@update')->name('produccion.producciones.update');
        Route::delete('/{id}', 'ProduccionAPIController@delete')->name('produccion.producciones.delete');
    });
});
