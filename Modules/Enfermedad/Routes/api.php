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

Route::prefix('v1/enfermedad')->middleware('auth:api')->group(function (){
    Route::prefix('/enfermedades')->group(function (){
        Route::get('/', 'EnfermedadAPIController@index')->name('enfermedad.enfermedades.index');
        Route::post('/', 'EnfermedadAPIController@store')->name('enfermedad.enfermedades.store');
        Route::put('/{id}', 'EnfermedadAPIController@update')->name('enfermedad.enfermedades.update');
        Route::delete('/{id}', 'EnfermedadAPIController@destroy')->name('enfermedad.enfermedades.destroy');
    });
});
