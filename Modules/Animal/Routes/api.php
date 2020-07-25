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

Route::prefix('/v1/animal/')->middleware('auth:api')->group(function () {

    Route::prefix('animales')->group(function () {
        Route::get('/', 'AnimalAPIController@index')->name('animal.animales.index');
        Route::post('/', 'AnimalAPIController@store')->name('animal.animales.store');
        Route::put('/{id}', 'AnimalAPIController@update')->name('animal.animales.update');
        Route::delete('/{id}', 'AnimalAPIController@destroy')->name('animal.animales.destroy');
        Route::post('/import/{negocio_id}', 'AnimalAPIController@importAnimales')->name('animal.animales.importAnimales');
    });

    Route::prefix('celos')->group(function () {
        Route::get('/', 'CeloAPIController@index')->name('animal.celos.index');
        Route::post('/', 'CeloAPIController@store')->name('animal.celos.store');
        Route::put('/{id}', 'CeloAPIController@update')->name('animal.celos.update');
        Route::delete('/{id}', 'CeloAPIController@destroy')->name('animal.celos.destroy');

    });

    Route::prefix('palpaciones')->group(function () {
        Route::get('/', 'PalpacionAPIController@index')->name('animal.palpaciones.index');
        Route::post('/', 'PalpacionAPIController@store')->name('animal.palpaciones.store');
        Route::put('/{id}', 'PalpacionAPIController@update')->name('animal.palpaciones.update');
        Route::delete('/{id}', 'PalpacionAPIController@destroy')->name('animal.palpaciones.destroy');

    });

    Route::prefix('leches')->group(function () {
        Route::get('/', 'LecheAPIController@index')->name('animal.leches.index');
        Route::post('/', 'LecheAPIController@store')->name('animal.leches.store');
        Route::put('/{id}', 'LecheAPIController@update')->name('animal.leches.update');
        Route::delete('/{id}', 'LecheAPIController@destroy')->name('animal.leches.destroy');

    });

});


