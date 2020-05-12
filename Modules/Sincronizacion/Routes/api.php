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



Route::prefix('v1/sincronizacion')->group(function(){

    Route::prefix('sincronizaciones')->group(function () {
        Route::post('/', 'SyncronizacionAPIController@store')->name('configuracion.store');
        Route::post('/start', 'SyncronizacionAPIController@startSync')->name('sync.data');

    });

});


