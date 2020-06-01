<?php

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

Route::post('v1/auth/register', 'Auth\RegisterController@register')->name('auth.register');
Route::post('v1/auth/login', 'Auth\LoginController@login')->name('auth.login');

Route::prefix('v1/auth')->middleware('auth:api')->group(function () {

    Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');

    Route::get('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::get('/email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');

});

Route::prefix('v1/usuario')->middleware('auth:api')->group(function () {
    Route::prefix('usuarios')->group(function () {
        Route::get('/', 'UserAPIController@index')->name('usuario.usuarios.index');
        Route::post('/', 'UserAPIController@store')->name('usuario.usuarios.store');
        Route::put('/{id}', 'UserAPIController@update')->name('usuario.usuarios.update');
        Route::delete('/{id}', 'UserAPIController@delete')->name('usuario.usuarios.delete');
    });

    Route::prefix('clientes_negocios')->group(function () {
        Route::get('/', 'ClienteNegocioAPIController@index')->name('usuario.clientes_negocios.index');
        Route::get('/{id}', 'ClienteNegocioAPIController@show')->name('usuario.clientes_negocios.show');
        Route::post('/', 'ClienteNegocioAPIController@store')->name('usuario.clientes_negocios.store');
        Route::put('/{id}', 'ClienteNegocioAPIController@update')->name('usuario.clientes_negocios.update');
        Route::delete('/{id}', 'ClienteNegocioAPIController@delete')->name('usuario.clientes_negocios.delete');
    });

});

Route::prefix('v1/role')->middleware('auth:api')->group(function () {
    Route::prefix('/roles')->group(function () {
        Route::get('/', 'RoleAPIController@index')->name('role.roles.index');
        Route::get('/{id}', 'RoleAPIController@show')->name('role.roles.show');
        Route::post('/', 'RoleAPIController@store')->name('role.roles.store');
        Route::put('/{id}', 'RoleAPIController@update')->name('role.roles.update');
        Route::delete('/{id}', 'RoleAPIController@destroy')->name('role.roles.delete');
        Route::post('/{id}/give/permission', 'RoleAPIController@givePermissionToRole')->name('role.roles.give_permission');
    });
});

Route::prefix('v1/permiso')->middleware('auth:api')->group(function () {
    Route::prefix('/permisos')->group(function () {
        Route::get('/', 'PermissionAPIController@index')->name('permiso.permisos.index');
        Route::get('/{id}', 'PermissionAPIController@show')->name('permiso.permisos.show');
        Route::post('/', 'PermissionAPIController@store')->name('permiso.permisos.store');
        Route::put('/{id}', 'PermissionAPIController@update')->name('permiso.permisos.update');
        Route::delete('/{id}', 'PermissionAPIController@destroy')->name('permiso.permisos.delete');
    });
});




