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

Route::middleware('auth:api')->get('/sincronizacion', function (Request $request) {
    return $request->user();
});


Route::prefix('v1/sincronizacion')->group(function(){

    Route::prefix('sincronizaciones')->group(function () {
//        Route::get('/', 'SyncronizacionAPIController@index')->name('configuracion.index');
        Route::post('/', 'SyncronizacionAPIController@store')->name('configuracion.store');
//        Route::put('/{id}', 'SyncronizacionAPIController@update')->name('configuracion.update');
//        Route::delete('/{id}', 'SyncronizacionAPIController@destroy')->name('configuracion.delete');
    });

});


Route::resource('syncronizacions', 'SyncronizacionAPIController');
Route::post('/sync', 'SyncronizacionAPIController@startSync')->name('sync.data');
