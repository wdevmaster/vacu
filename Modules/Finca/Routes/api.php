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



Route::prefix('v1/finca')->middleware('auth:api')->group(function () {
    Route::prefix('fincas')->group(function () {
        Route::get('/', 'FincaAPIController@index')->name('finca.fincas.index');
        Route::post('/', 'FincaAPIController@store')->name('finca.fincas.store');
        Route::put('/{id}', 'FincaAPIController@update')->name('finca.fincas.update');
        Route::delete('/{id}', 'FincaAPIController@destroy')->name('finca.fincas.delete');
    });
});
