<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->animalRepository()->get();
        return response()->json($list, 200);
    }

    public function findByCode($codigo)
    {
        $animal = $this->animalRepository()->where('codigo',$codigo)->first();
        return response()->json($animal, 200); 
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $animal = $this->animalRepository()->insert(
            ['codigo' => $request->codigo, 'fecha_nacimiento' =>  $request->fecha_nacimiento, 'lote_actual_Id' =>  $request->lote_actual_Id,'lote_nacimientoId' =>  $request->lote_nacimientoId, 'madreCodigo' => $request->madreCodigo, 'padreCodigo' => $request->padreCodigo, 'raza_codigo' => $request->raza_codigo, 'sexo' => $request->sexo, 'active' => true]
        );
        return response()->json($animal, 201); 
    }

    public function desabilitar($codigo)
    {
        $animal = $this->animalRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($animal, 200); 
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
        $animal = $this->animalRepository()
              ->where('codigo', $codigo)
              ->update(['fecha_nacimiento' =>  $request->fecha_nacimiento, 'lote_actual_Id' =>  $request->lote_actual_Id,'lote_nacimientoId' =>  $request->lote_nacimientoId, 'madreCodigo' => $request->madreCodigo, 'padreCodigo' => $request->padreCodigo, 'raza_codigo' => $request->raza_codigo, 'sexo' => $request->sexo]);

        return response()->json($animal, 200); 
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
