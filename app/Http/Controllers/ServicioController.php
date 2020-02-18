<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->servicioRepository()->get();
        return response()->json($list, 200);     
    }
    public function list($negocio)
    {        
        $list = $this->servicioRepository()
        ->join('animal', 'servicio.animal_inseminado_codigo', '=', 'animal.codigo')
        ->join('lote', 'animal.lote_actual_Id', '=', 'lote.idLote')
        ->join('finca', 'lote.fincaId', '=', 'finca.idfinca')
        ->where('negocioId',$negocio)->where('active',true)->get();
        return response()->json($list, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $code = $this->getCode($request->codigo);
        $animalInseminado = $this->verifyCode('animal', $request->animal_inseminado_codigo);
        $animalInseminador = $this->verifyCode('animal', $request->animal_inseminador_codigo);
        $personaInseminador = $this->verifyCode('inseminador', $request->persona_inseminador_codigo);
        $semen = $this->verifyCode('semen', $request->semen_codigo);

        $servicio = $this->servicioRepository()->insert(
            ['codigo' => $code, 'animal_inseminado_codigo' =>  $animalInseminado, 'animal_inseminador_codigo' =>  $animalInseminador,'fecha' =>  $request->fecha, 'persona_inseminador_codigo' => $personaInseminador, 'semen_codigo' => $semen, 'tipoId' => $request->tipoId, 'active' => true]
        );
        return response()->json($servicio, 201); 
    }

    public function desabilitar($codigo)
    {
        $servicio = $this->servicioRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($servicio, 200); 
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $codigo)
    {
        $servicio = $this->servicioRepository()
              ->where('codigo', $codigo)
              ->update(['animal_inseminado_codigo' =>  $request->animal_inseminado_codigo, 'animal_inseminador_codigo' =>  $request->animal_inseminador_codigo,'fecha' =>  $request->fecha, 'persona_inseminador_codigo' => $request->persona_inseminador_codigo, 'semen_codigo' => $request->semen_codigo, 'tipoId' => $request->tipoId]);

        return response()->json($servicio, 200); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getCode($codigo)
    {
        if($this->servicioRepository()->where('codigo', $codigo)->exists())
        {
         $last = $this->servicioRepository()->orderby('codigo','DESC')->first();
         $new_code = $last->codigo + 1;
         $this->sincronizacionRepository()->insert(
            ['codigo_actual' => $new_code, 'codigo_remoto' =>  $codigo, 'tabla' =>  'servicio']
        );  
            return $new_code;
        }
        else
        {
            return $codigo;
        }
    }
}
