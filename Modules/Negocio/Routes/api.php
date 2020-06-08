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


Route::prefix('v1/negocio')->middleware('auth:api')->group(function (){
    Route::prefix('/negocios')->group(function (){
        Route::get('/', 'NegocioAPIController@index')->name('negocio.negocios.index');
        Route::post('/', 'NegocioAPIController@store')->name('negocio.negocios.store');
        Route::put('/{id}', 'NegocioAPIController@update')->name('negocio.negocios.update');
        Route::delete('/{id}', 'NegocioAPIController@destroy')->name('negocio.negocios.delete');
    });

});

