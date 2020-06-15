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

Route::prefix('v1/lote')->middleware('auth:api')->group(function () {
    Route::prefix('lotes')->group(function () {
        Route::get('/', 'LoteAPIController@index')->name('lote.lotes.index');
        Route::post('/', 'LoteAPIController@store')->name('lote.lotes.store');
        Route::put('/{id}', 'LoteAPIController@update')->name('lote.lotes.update');
        Route::get('/{id}', 'LoteAPIController@show')->name('lote.lotes.show');
        Route::delete('/{id}', 'LoteAPIController@destroy')->name('lote.lotes.delete');
    });
});
