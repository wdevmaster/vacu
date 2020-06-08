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

Route::prefix('v1/locomocion')->middleware('auth:api')->group(function () {
    Route::prefix('locomociones')->group(function () {
        Route::get('/', 'LocomocionAPIController@index')->name('locomocion.locomociones.index');
        Route::post('/', 'LocomocionAPIController@store')->name('locomocion.locomociones.store');
        Route::put('/{id}', 'LocomocionAPIController@update')->name('locomocion.locomociones.update');
        Route::delete('/{id}', 'LocomocionAPIController@destroy')->name('locomocion.locomociones.delete');
    });
});

