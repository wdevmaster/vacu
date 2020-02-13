<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstadoFisicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->estadoFisicoRepository()->get();
        return response()->json($list, 200);
    }

    public function findByCode($codigo)
    {
        $estado = $this->estadoFisicoRepository()->where('codigo',$codigo)->first();
        return response()->json($estado, 200); 
    }

    public function estadosByAnimal($animal)
    {
        $estados = $this->estadoFisicoRepository()->where('animal_codigo',$animal)->get();;
        return response()->json($estados, 200); 
    }
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $estado = $this->estadoFisicoRepository()->insert(
            ['codigo' => $request->codigo, 'animal_codigo' =>  $request->animal_codigo, 'condicion_corporal_codigo' =>  $request->condicion_corporal_codigo, 'fecha' =>  $request->fecha, 'locomocion_codigo' => $request->locomocion_codigo, 'active' => true]
        );
        return response()->json($estado, 201); 
    }

    public function desabilitar($codigo)
    {
        $estado = $this->estadoFisicoRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($estado, 200); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
