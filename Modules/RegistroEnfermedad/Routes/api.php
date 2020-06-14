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

Route::prefix('v1/registro_enfermedad')->middleware('auth:api')->group(function () {
    Route::prefix('registros_enfermedades')->group(function () {
        Route::get('/', 'RegistroEnfermedadAPIController@index')->name('registro_enfermedad.registros_enfermedades.index');
        Route::post('/', 'RegistroEnfermedadAPIController@store')->name('registro_enfermedad.registros_enfermedades.store');
        Route::put('/{id}', 'RegistroEnfermedadAPIController@update')->name('registro_enfermedad.registros_enfermedades.update');
        Route::get('/{id}', 'RegistroEnfermedadAPIController@show')->name('registro_enfermedad.registros_enfermedades.show');
        Route::delete('/{id}', 'RegistroEnfermedadAPIController@destroy')->name('registro_enfermedad.registros_enfermedades.delete');
    });
});

