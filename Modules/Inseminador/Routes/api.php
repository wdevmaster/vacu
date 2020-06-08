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


Route::prefix('v1/inseminador')->middleware('auth:api')->group(function () {
    Route::prefix('inseminadores')->group(function () {
        Route::get('/', 'InseminadorAPIController@index')->name('inseminador.inseminadores.index');
        Route::post('/', 'InseminadorAPIController@store')->name('inseminador.inseminadores.store');
        Route::put('/{id}', 'InseminadorAPIController@update')->name('inseminador.inseminadores.update');
        Route::delete('/{id}', 'InseminadorAPIController@destroy')->name('inseminador.inseminadores.delete');
    });
});
