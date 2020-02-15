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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', 'UserController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {
    
    Route::post('register', 'UserController@register');
    Route::post('/logout', 'UserController@logout');
// -----------------Rutas animal-------------------
    Route::get('animales','AnimalController@index');
    Route::get('animal/{codigo}','AnimalController@findByCode');
    Route::post('animales','AnimalController@store');
    Route::put('animal/desabilitar/{codigo}','AnimalController@desabilitar');
    Route::put('animal/{codigo}','AnimalController@update');

    // -----------------Rutas cliente-------------------
    Route::get('clientes','ClienteController@index');
    Route::get('cliente/{codigo}','ClienteController@findByCode');
    Route::post('clientes','ClienteController@store');
    Route::put('cliente/desabilitar/{codigo}','ClienteController@desabilitar');
    Route::put('cliente/{codigo}','ClienteController@update');


    // -----------------Rutas condicion corporal-------------------
    Route::get('condiciones_corporales','CondicionCorporalController@index');
    Route::get('condicion/{codigo}','CondicionCorporalController@findByCode');
    Route::post('condiciones_corporales','CondicionCorporalController@store');
    Route::put('condicion/desabilitar/{codigo}','CondicionCorporalController@desabilitar');
    Route::put('condicion/{codigo}','CondicionCorporalController@update');


    // -----------------Rutas configuracion-------------------
    Route::get('configuraciones','ConfiguracionController@index');
    Route::get('roles','ConfiguracionController@getRoles');
    Route::get('sincronizar','ConfiguracionController@sincronizar');
    Route::get('desconectar','ConfiguracionController@desconectar');
    Route::get('configuracion/{key}','ConfiguracionController@findByKey');
    Route::post('configuraciones','ConfiguracionController@store');
    Route::put('configuracion/{codigo}','ConfiguracionController@update');


    // -----------------Rutas enfermedad-------------------
    Route::get('enfermedades','EnfermedadController@index');
    Route::get('enfermedad/{codigo}','EnfermedadController@findByCode');
    Route::post('enfermedades','EnfermedadController@store');
    Route::put('enfermedad/desabilitar/{codigo}','EnfermedadController@desabilitar');
    Route::put('enfermedad/{codigo}','EnfermedadController@update');


    // -----------------Rutas estado fisico-------------------
    Route::get('estados_fisicos','EstadoFisicoController@index');
    Route::get('estado/{codigo}','EstadoFisicoController@findByCode');
    Route::post('estados_fisicos','EstadoFisicoController@store');
    Route::put('estado/desabilitar/{codigo}','EstadoFisicoController@desabilitar');
    Route::put('estado/{codigo}','EstadoFisicoController@update');


    // -----------------Rutas finca-------------------
    Route::get('fincas','FincaController@index');
    Route::get('finca/{id}','FincaController@findById');
    Route::post('fincas','FincaController@store');
    Route::put('finca/desabilitar/{id}','FincaController@desabilitar');
    Route::put('finca/{id}','FincaController@update');


    // -----------------Rutas ingreso-------------------
    Route::get('ingreso','IngresoController@index');
    Route::get('ingreso/{codigo}','IngresoController@findByCode');
    Route::post('ingreso','IngresoController@store');
    Route::put('ingreso/desabilitar/{codigo}','IngresoController@desabilitar');
    Route::put('ingreso/{codigo}','IngresoController@update');


    // -----------------Rutas inseminador-------------------
    Route::get('inseminadores','InseminadorController@index');
    Route::get('inseminador/{codigo}','InseminadorController@findByCode');
    Route::post('inseminadores','InseminadorController@store');
    Route::put('inseminador/desabilitar/{codigo}','InseminadorController@desabilitar');
    Route::put('inseminador/{codigo}','InseminadorController@update');


    // -----------------Rutas lactancia-------------------
    Route::get('lactancias','LactanciaController@index');
    Route::get('lactancia/{codigo}','InseminadorController@findByCode');
    Route::get('lactancia/animal/{animal}','InseminadorController@lactanciaByAnimal');
    Route::post('lactancias','InseminadorController@store');
    Route::put('lactancia/desabilitar/{codigo}','InseminadorController@desabilitar');
    Route::put('lactancia/{codigo}','InseminadorController@update');


    // -----------------Rutas locomocion-------------------
    Route::get('locomociones','LocomocionController@index');
    Route::get('locomocion/{codigo}','LocomocionController@findByCode');
    Route::post('locomociones','LocomocionController@store');
    Route::put('locomocion/desabilitar/{codigo}','LocomocionController@desabilitar');
    Route::put('locomocion/{codigo}','LocomocionController@update');



    // -----------------Rutas lote-------------------
    Route::get('lotes','LoteController@index');
    Route::get('lote/{id}','LoteController@findById');
    Route::post('lotes','LoteController@store');
    Route::put('lote/desabilitar/{id}','LoteController@desabilitar');
    Route::put('lote/{id}','LoteController@update');

    // -----------------Rutas muerte-------------------
    Route::get('muertes','MuerteController@index');
    Route::get('muerte/{codigo}','MuerteController@findByCode');
    Route::post('muertes','MuerteController@store');
    Route::put('muerte/{codigo}','MuerteController@update');


    // -----------------Rutas negocio-------------------
    Route::get('negocios','NegocioController@index');
    Route::get('negocio/{id}','NegocioController@findById');
    Route::post('negocios','NegocioController@store');
    Route::put('negocio/{id}','NegocioController@update');


    // -----------------Rutas parto-------------------
    Route::get('partos','PartoController@index');
    Route::get('parto/{codigo}','PartoController@findByCode');
    Route::post('partos','PartoController@store');
    Route::put('parto/desabilitar/{codigo}','PartoController@desabilitar');
    Route::put('parto/{codigo}','PartoController@update');


    // -----------------Rutas produccion-------------------
    Route::get('producciones','ProduccionController@index');
    Route::post('producciones','ProduccionController@store');
    Route::put('produccion/desabilitar/{codigo}','ProduccionController@desabilitar');
    Route::put('produccion/{codigo}','ProduccionController@update');


    // -----------------Rutas raza-------------------
    Route::get('razas','RazaController@index');
    Route::post('razas','RazaController@store');
    Route::put('raza/desabilitar/{codigo}','RazaController@desabilitar');
    Route::put('raza/{codigo}','RazaController@update');


    // -----------------Rutas registro enfermedad-------------------
    Route::get('registros_enfermedades','RegistroEnfermedadController@index');
    Route::post('registros','RegistroEnfermedadController@store');
    Route::put('registro/desabilitar/{codigo}','RegistroEnfermedadController@desabilitar');
    Route::put('registro/{codigo}','RegistroEnfermedadController@update');

    // -----------------Rutas semen-------------------
    Route::get('semen','SemenController@index');
    Route::post('semen','SemenController@store');
    Route::put('semen/desabilitar/{codigo}','SemenController@desabilitar');
    Route::put('semen/{codigo}','SemenController@update');


    // -----------------Rutas servicio-------------------
    Route::get('servicios','ServicioController@index');
    Route::post('servicios','ServicioController@store');
    Route::put('servicio/desabilitar/{codigo}','ServicioController@desabilitar');
    Route::put('servicio/{codigo}','ServicioController@update');


    // -----------------Rutas tipo servicios-------------------
    Route::get('tipo_servicios','TipoServiciosController@index');


    // -----------------Rutas venta-------------------
    Route::get('ventas','VentaController@index');
    Route::post('ventas','VentaController@store');
    Route::put('venta/desabilitar/{codigo}','VentaController@desabilitar');
    Route::put('venta/{codigo}','VentaController@update');


});
