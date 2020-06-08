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





Route::prefix('v1/estado_fisico')->middleware('auth:api')->group(function () {
    Route::prefix('estados_fisicos')->group(function () {
        Route::get('/', 'EstadoFisicoAPIController@index')->name('estado_fisico.estados_fisicos.index');
        Route::post('/', 'EstadoFisicoAPIController@store')->name('estado_fisico.estados_fisicos.store');
        Route::put('/{id}', 'EstadoFisicoAPIController@update')->name('estado_fisico.estados_fisicos.update');
        Route::delete('/{id}', 'EstadoFisicoAPIController@destroy')->name('estado_fisico.estados_fisicos.delete');
    });
});
