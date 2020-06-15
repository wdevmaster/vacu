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

Route::prefix('v1/semen')->middleware('auth:api')->group(function () {
    Route::prefix('semens')->group(function () {
        Route::get('/', 'SemenAPIController@index')->name('semen.semens.index');
        Route::post('/', 'SemenAPIController@store')->name('semen.semens.store');
        Route::put('/{id}', 'SemenAPIController@update')->name('semen.semens.update');
        Route::get('/{id}', 'SemenAPIController@show')->name('semen.semens.show');
        Route::delete('/{id}', 'SemenAPIController@destroy')->name('semen.semens.delete');
    });
});

