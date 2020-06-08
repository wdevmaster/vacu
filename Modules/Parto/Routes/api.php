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

Route::prefix('v1/parto')->middleware('auth:api')->group(function () {
    Route::prefix('partos')->group(function () {
        Route::get('/', 'PartoAPIController@index')->name('parto.partos.index');
        Route::post('/', 'PartoAPIController@store')->name('parto.partos.store');
        Route::put('/{id}', 'PartoAPIController@update')->name('parto.partos.update');
        Route::delete('/{id}', 'PartoAPIController@destroy')->name('parto.partos.delete');
    });
});
