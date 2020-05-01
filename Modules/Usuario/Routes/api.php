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

//Route::prefix('v1/usuario')->group(function(){
//    Route::post('/auth/login', 'LoginController@login')->name('login');
//    Route::post('/auth/login/refresh', 'LoginController@refresh')->name('refresh');
//});

Route::prefix('v1/usuario')->group(function(){
//    Route::get('/auth/logout', 'LoginController@logout')->name('user.logout');
//    Route::get('/auth/logged_user', 'LoginController@loggedUser')->name('user.loggedUser');

    Route::prefix('/usuarios')->group(function(){
        Route::get('/', 'UserAPIController@index')->name('user.users.index');
        Route::get('/{id}', 'UserAPIController@show')->name('user.users.show');
        Route::get('/filter/all', 'UserAPIController@filter')->name('user.users.filter');
        Route::post('/', 'UserAPIController@store')->name('user.users.store');
        Route::put('/{id}', 'UserAPIController@update')->name('user.users.update');
        Route::delete('/{id}', 'UserAPIController@destroy')->name('user.users.destroy');

    });

//    Route::prefix('/roles')->group(function(){
//        Route::get('/', 'RolController@index')->name('user.roles.index');
//    });
});
