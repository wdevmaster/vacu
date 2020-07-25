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
        Route::get('/{id}', 'MuerteAPIController@show')->name('muerte.muertes.show');
        Route::delete('/{id}', 'MuerteAPIController@destroy')->name('muerte.muertes.delete');
    });
});

Route::prefix('v1/muerte')->middleware('auth:api')->group(function () {
    Route::prefix('motivo_muertes')->group(function () {
        Route::get('/', 'MotivoMuerteAPIController@index')->name('muerte.motivo_muertes.index');
        Route::post('/', 'MotivoMuerteAPIController@store')->name('muerte.motivo_muertes.store');
        Route::put('/{id}', 'MotivoMuerteAPIController@update')->name('muerte.motivo_muertes.update');
        Route::delete('/{id}', 'MotivoMuerteAPIController@destroy')->name('muerte.motivo_muertes.delete');
    });
});

