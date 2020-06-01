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
    Route::prefix('registros_emfermedades')->group(function () {
        Route::get('/', 'RegistroEnfermedadAPIController@index')->name('registro_enfermedad.registros_emfermedades.index');
        Route::post('/', 'RegistroEnfermedadAPIController@store')->name('registro_enfermedad.registros_emfermedades.store');
        Route::put('/{id}', 'RegistroEnfermedadAPIController@update')->name('registro_enfermedad.registros_emfermedades.update');
        Route::delete('/{id}', 'RegistroEnfermedadAPIController@delete')->name('registro_enfermedad.registros_emfermedades.delete');
    });
});

