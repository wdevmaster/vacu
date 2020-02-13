<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroEnfermedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->registroEnfermedadRepository()->get();
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
        $registro = $this->registroEnfermedadRepository()->insert(
            ['codigo' => $request->codigo, 'animal_codigo' =>  $request->animal_codigo, 'enfermedad_codigo' =>  $request->enfermedad_codigo,'fecha' =>  $request->fecha, 'active' => true]
        );
        return response()->json($registro, 201); 
    }

    public function desabilitar($codigo)
    {
        $registro = $this->registroEnfermedadRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($registro, 200); 
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
        $registro = $this->registroEnfermedadRepository()
              ->where('codigo', $codigo)
              ->update(['animal_codigo' =>  $request->animal_codigo, 'enfermedad_codigo' =>  $request->enfermedad_codigo,'fecha' =>  $request->fecha]);

        return response()->json($registro, 200); 
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
