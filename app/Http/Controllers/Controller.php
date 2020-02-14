<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  
    public function animalRepository()
    {
        return DB::table('animal');
    }
    public function clienteRepository()
    {
        return DB::table('cliente');
    }
    public function condicionCorporalRepository()
    {
        return DB::table('condicion_corporal');
    }
    public function configuracionRepository()
    {
        return DB::table('configuracion');
    }
    public function enfermedadRepository()
    {
        return DB::table('enfermedad');
    }
    public function estadoFisicoRepository()
    {
        return DB::table('estado_fisico');
    }
    public function fincaRepository()
    {
        return DB::table('finca');
    }
    public function ingresoRepository()
    {
        return DB::table('ingreso');
    }
    public function inseminadorRepository()
    {
        return DB::table('inseminador');
    }
    public function lactanciaRepository()
    {
        return DB::table('lactancia');
    }
    public function locomocionRepository()
    {
        return DB::table('locomocion');
    }
    public function loteRepository()
    {
        return DB::table('lote');
    }
    public function motivoMuerteRepository()
    {
        return DB::table('motivo_muerte');
    }
    public function muerteRepository()
    {
        return DB::table('muerte');
    }
    public function negocioRepository()
    {
        return DB::table('negocio');
    }
    public function partoRepository()
    {
        return DB::table('parto');
    }
    public function permisoRepository()
    {
        return DB::table('permiso');
    }
    public function produccionRepository()
    {
        return DB::table('produccion');
    }
    public function razaRepository()
    {
        return DB::table('raza');
    }
    public function registroEnfermedadRepository()
    {
        return DB::table('registro_enfermedad');
    }
    public function rolRepository()
    {
        return DB::table('rol');
    }
    public function semenRepository()
    {
        return DB::table('semen');
    }
    public function servicioRepository()
    {
        return DB::table('servicio');
    }
    public function sincronizacionRepository()
    {
        return DB::table('sincronizacion');
    }
    public function tipoServicioRepository()
    {
        return DB::table('tipo_servicio');
    }
    public function usuarioRepository()
    {
        return DB::table('usuario');
    }
    public function usuarioPermisosRepository()
    {
        return DB::table('usuario_has_permiso');
    }
    public function ventaRepository()
    {
        return DB::table('venta');
    }

    
    public function verifyCode($tabla,$codigo)
    {
        if($this->sincronizacionRepository()->where('tabla', $tabla)->where('codigo_remoto', $codigo)->exists())
        {
            $aux = $this->sincronizacionRepository()->where('tabla', $tabla)->where('codigo_remoto', $codigo)->first();

            return $aux->codigo_actual;
        }
        else
        {
            return $codigo;
        }
    }
    
}
