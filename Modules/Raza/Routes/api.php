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
Route::prefix('v1/raza')->middleware('auth:api')->group(function () {
    Route::prefix('razas')->group(function () {
        Route::get('/', 'RazaAPIController@index')->name('raza.razas.index');
        Route::post('/', 'RazaAPIController@store')->name('raza.razas.store');
        Route::put('/{id}', 'RazaAPIController@update')->name('raza.razas.update');
        Route::delete('/{id}', 'RazaAPIController@destroy')->name('raza.razas.delete');
    });
});

