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


Route::prefix('/v1/bitacora/')->middleware('auth:api')->group(function () {

    Route::prefix('bitacora')->group(function () {
        Route::get('/', 'BitacoraAPIController@index')->name('bitacoras.bitacora.index');

    });

});
