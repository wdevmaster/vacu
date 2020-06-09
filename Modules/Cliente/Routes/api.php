<?php

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

Route::prefix('v1/cliente')->middleware('auth:api')->group(function () {
    Route::prefix('/clientes')->group(function () {
        Route::get('/', 'ClienteAPIController@index')->name('cliente.clientes.index');
        Route::post('/', 'ClienteAPIController@store')->name('cliente.clientes.store');
        Route::get('/{id}', 'ClienteAPIController@update')->name('cliente.clientes.update');
        Route::get('/{id}', 'ClienteAPIController@destroy')->name('cliente.clientes.destroy');
    });
});

