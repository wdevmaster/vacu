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



Route::prefix('v1/sincronizacion')->middleware('auth:api')->group(function(){

    Route::prefix('sincronizaciones')->group(function () {
        Route::post('/', 'SyncronizacionAPIController@store')->name('sync.store');
        Route::get('/start/{negocio_id}', 'SyncronizacionAPIController@startSync')->name('sync.data');

    });

});


