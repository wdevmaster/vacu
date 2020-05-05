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

Route::middleware('auth:api')->get('/animal', function (Request $request) {
    return $request->user();
});


Route::prefix('v1/animal')->group(function(){

//    Route::get('animales','AnimalController@index');
//    Route::get('animales/list/{negocio}','AnimalController@list');
//    Route::get('animal/{codigo}','AnimalController@findByCode');
//    Route::post('animales','AnimalController@store');
//    Route::put('animal/inactivar/{codigo}','AnimalController@inactivar');
//    Route::put('animal/{codigo}','AnimalController@update');

});


// -----------------Rutas animal-------------------


Route::resource('animals', 'AnimalAPIController');
