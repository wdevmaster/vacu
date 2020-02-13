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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $servicio = $this->servicioRepository()->insert(
            ['codigo' => $request->codigo, 'animal_inseminado_codigo' =>  $request->animal_inseminado_codigo, 'animal_inseminador_codigo' =>  $request->animal_inseminador_codigo,'fecha' =>  $request->fecha, 'persona_inseminador_codigo' => $request->persona_inseminador_codigo, 'semen_codigo' => $request->semen_codigo, 'tipoId' => $request->tipoId, 'active' => true]
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
}
