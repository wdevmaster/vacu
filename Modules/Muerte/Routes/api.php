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

Route::prefix('v1/muerte')->middleware('auth:api')->group(function () {
    Route::prefix('muertes')->group(function () {
        Route::get('/', 'MuerteAPIController@index')->name('muerte.muertes.index');
        Route::post('/', 'MuerteAPIController@store')->name('muerte.muertes.store');
        Route::put('/{id}', 'MuerteAPIController@update')->name('muerte.muertes.update');
        Route::delete('/{id}', 'MuerteAPIController@delete')->name('muerte.muertes.delete');
    });
});

