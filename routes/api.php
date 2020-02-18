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
    Route::get('animales/list/{negocio}','AnimalController@list');
    Route::get('animal/{codigo}','AnimalController@findByCode');
    Route::post('animales','AnimalController@store');
    Route::put('animal/inactivar/{codigo}','AnimalController@inactivar');
    Route::put('animal/{codigo}','AnimalController@update');

    // -----------------Rutas cliente-------------------
    Route::get('clientes','ClienteController@index');
    Route::get('clientes/list/{negocio}','ClienteController@list');
    Route::get('cliente/{codigo}','ClienteController@findByCode');
    Route::post('clientes','ClienteController@store');
    Route::put('cliente/inactivar/{codigo}','ClienteController@inactivar');
    Route::put('cliente/{codigo}','ClienteController@update');


    // -----------------Rutas condicion corporal-------------------
    Route::get('condiciones_corporales','CondicionCorporalController@index');
    Route::get('condiciones_corporales/list/{negocio}','CondicionCorporalController@list');
    Route::get('condicion/{codigo}','CondicionCorporalController@findByCode');
    Route::post('condiciones_corporales','CondicionCorporalController@store');
    Route::put('condicion/inactivar/{codigo}','CondicionCorporalController@inactivar');
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
    Route::get('enfermedades/list/{negocio}','EnfermedadController@list');
    Route::get('enfermedad/{codigo}','EnfermedadController@findByCode');
    Route::post('enfermedades','EnfermedadController@store');
    Route::put('enfermedad/inactivar/{codigo}','EnfermedadController@inactivar');
    Route::put('enfermedad/{codigo}','EnfermedadController@update');


    // -----------------Rutas estado fisico-------------------
    Route::get('estados_fisicos','EstadoFisicoController@index');
    Route::get('estados_fisicos/list/{negocio}','EstadoFisicoController@list');
    Route::get('estado/{codigo}','EstadoFisicoController@findByCode');
    Route::post('estados_fisicos','EstadoFisicoController@store');
    Route::put('estado/inactivar/{codigo}','EstadoFisicoController@inactivar');
    Route::put('estado/{codigo}','EstadoFisicoController@update');


    // -----------------Rutas finca-------------------
    Route::get('fincas','FincaController@index');
    Route::get('fincas/list/{negocio}','FincaController@list');
    Route::get('finca/{id}','FincaController@findById');
    Route::post('fincas','FincaController@store');
    Route::put('finca/inactivar/{id}','FincaController@inactivar');
    Route::put('finca/{id}','FincaController@update');


    // -----------------Rutas ingreso-------------------
    Route::get('ingreso','IngresoController@index');
    Route::get('ingreso/list/{negocio}','IngresoController@list');
    Route::get('ingreso/{codigo}','IngresoController@findByCode');
    Route::post('ingreso','IngresoController@store');
    Route::put('ingreso/inactivar/{codigo}','IngresoController@inactivar');
    Route::put('ingreso/{codigo}','IngresoController@update');


    // -----------------Rutas inseminador-------------------
    Route::get('inseminadores','InseminadorController@index');
    Route::get('inseminadores/list/{negocio}','InseminadorController@list');
    Route::get('inseminador/{codigo}','InseminadorController@findByCode');
    Route::post('inseminadores','InseminadorController@store');
    Route::put('inseminador/inactivar/{codigo}','InseminadorController@inactivar');
    Route::put('inseminador/{codigo}','InseminadorController@update');


    // -----------------Rutas lactancia-------------------
    Route::get('lactancias','LactanciaController@index');
    Route::get('lactancias/list/{negocio}','LactanciaController@list');
    Route::get('lactancia/{codigo}','InseminadorController@findByCode');
    Route::get('lactancia/animal/{animal}','InseminadorController@lactanciaByAnimal');
    Route::post('lactancias','InseminadorController@store');
    Route::put('lactancia/inactivar/{codigo}','InseminadorController@inactivar');
    Route::put('lactancia/{codigo}','InseminadorController@update');


    // -----------------Rutas locomocion-------------------
    Route::get('locomociones','LocomocionController@index');
    Route::get('locomociones/list/{negocio}','LocomocionController@list');
    Route::get('locomocion/{codigo}','LocomocionController@findByCode');
    Route::post('locomociones','LocomocionController@store');
    Route::put('locomocion/inactivar/{codigo}','LocomocionController@inactivar');
    Route::put('locomocion/{codigo}','LocomocionController@update');



    // -----------------Rutas lote-------------------
    Route::get('lotes','LoteController@index');
    Route::get('lotes/list/{negocio}','LoteController@list');
    Route::get('lote/{id}','LoteController@findById');
    Route::post('lotes','LoteController@store');
    Route::put('lote/inactivar/{id}','LoteController@inactivar');
    Route::put('lote/{id}','LoteController@update');

    // -----------------Rutas muerte-------------------
    Route::get('muertes','MuerteController@index');
    Route::get('muertes/list/{negocio}','MuerteController@list');
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
    Route::get('partos/list/{negocio}','PartoController@list');
    Route::get('parto/{codigo}','PartoController@findByCode');
    Route::post('partos','PartoController@store');
    Route::put('parto/inactivar/{codigo}','PartoController@inactivar');
    Route::put('parto/{codigo}','PartoController@update');


    // -----------------Rutas produccion-------------------
    Route::get('producciones','ProduccionController@index');
    Route::get('producciones/list/{negocio}','ProduccionController@list');
    Route::post('producciones','ProduccionController@store');
    Route::put('produccion/inactivar/{codigo}','ProduccionController@inactivar');
    Route::put('produccion/{codigo}','ProduccionController@update');


    // -----------------Rutas raza-------------------
    Route::get('razas','RazaController@index');
    Route::get('razas/list/{negocio}','RazaController@list');
    Route::post('razas','RazaController@store');
    Route::put('raza/inactivar/{codigo}','RazaController@inactivar');
    Route::put('raza/{codigo}','RazaController@update');


    // -----------------Rutas registro enfermedad-------------------
    Route::get('registros_enfermedades','RegistroEnfermedadController@index');
    Route::get('registros_enfermedades/list/{negocio}','RegistroEnfermedadController@list');
    Route::post('registros','RegistroEnfermedadController@store');
    Route::put('registro/inactivar/{codigo}','RegistroEnfermedadController@inactivar');
    Route::put('registro/{codigo}','RegistroEnfermedadController@update');

    // -----------------Rutas semen-------------------
    Route::get('semen','SemenController@index');
    Route::get('semen/list/{negocio}','SemenController@list');
    Route::post('semen','SemenController@store');
    Route::put('semen/inactivar/{codigo}','SemenController@inactivar');
    Route::put('semen/{codigo}','SemenController@update');


    // -----------------Rutas servicio-------------------
    Route::get('servicios','ServicioController@index');
    Route::get('servicios/list/{negocio}','ServicioController@list');
    Route::post('servicios','ServicioController@store');
    Route::put('servicio/inactivar/{codigo}','ServicioController@inactivar');
    Route::put('servicio/{codigo}','ServicioController@update');


    // -----------------Rutas tipo servicios-------------------
    Route::get('tipo_servicios','TipoServiciosController@index');


    // -----------------Rutas venta-------------------
    Route::get('ventas','VentaController@index');
    Route::get('ventas/list/{negocio}','VentaController@list');
    Route::post('ventas','VentaController@store');
    Route::put('venta/inactivar/{codigo}','VentaController@inactivar');
    Route::put('venta/{codigo}','VentaController@update');


});
