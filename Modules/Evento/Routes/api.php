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




Route::prefix('v1/evento')->middleware('auth:api')->group(function () {
    Route::prefix('eventos')->group(function () {
        Route::get('/', 'EventoAPIController@index')->name('evento.eventos.index');
        Route::post('/', 'EventoAPIController@store')->name('evento.eventos.store');
        Route::put('/{id}', 'EventoAPIController@update')->name('evento.eventos.update');
        Route::delete('/{id}', 'EventoAPIController@delete')->name('evento.eventos.delete');
    });
});
