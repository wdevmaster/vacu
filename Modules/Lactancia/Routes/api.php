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


Route::prefix('v1/lactancia')->middleware('auth:api')->group(function () {
    Route::prefix('lactancias')->group(function () {
        Route::get('/', 'LactanciaAPIController@index')->name('lactancia.lactancias.index');
        Route::post('/', 'LactanciaAPIController@store')->name('lactancia.lactancias.store');
        Route::put('/{id}', 'LactanciaAPIController@update')->name('lactancia.lactancias.update');
        Route::delete('/{id}', 'LactanciaAPIController@destroy')->name('lactancia.lactancias.delete');
    });
});

