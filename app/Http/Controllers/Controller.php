<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use JWTAuth;

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

    public function Sincronizar($token){

        $user = JWTAuth::authenticate($token);
        $userId = $user->id;
        
        $user_sinc = $this->configuracionRepository()->where('clave', 'USER_SINC')->first();
        $fecha_sinc = $this->configuracionRepository()->where('clave', 'DATE_SINC')->first();
        
        $tiempoEnMinutos = 0;
        if($fecha_sinc->valor!=null){
            $fechaIni = Carbon::parse($fecha_sinc->valor)->format('Y-m-d');
            $fechafin = Carbon::now()->format('Y-m-d');
            $tiempoEnMinutos = $fechaIni->diffInMinutes($fechafin);
        }

        if($user_sinc->valor===0 || $fecha_sinc->valor==null || $tiempoEnMinutos>15){

            //modificar variables de configuracion
            $this->configuracionRepository()
            ->where('clave', 'USER_SINC')
            ->update(['valor' =>  $userId]);
            $this->configuracionRepository()
            ->where('clave', 'DATE_SINC')
            ->update(['valor' =>  Carbon::now()->format('Y-m-d')]);

            $this->sincronizacionRepository()->delete(); //vaciar tabla sincronizacion
            return true;
        }
        else
        {
            return false;
        }
    }

    public function Desconectar()
    {
        $this->configuracionRepository()
        ->where('clave', 'USER_SINC')
        ->update(['valor' =>  0]);

        $this->sincronizacionRepository()->delete(); //vaciar tabla sincronizacion

        return true;
    }
    
    public function UserSincronizando($token)
    {
        $user = JWTAuth::authenticate($token);
        $userId = $user->id;
        if($this->configuracionRepository()->where('clave', 'USER_SINC')->where('valor', $userId)->exists())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function UserInRol($userRolId, $rol)
    {
        $query = $this->rolRepository()->where('nombre', $rol)->first();
        $idRol = $query->idrol;
        if($userRolId===$idRol){
            return true;
        }
        else
        {
            return false;
        }
    }
}
