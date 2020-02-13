<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnfermedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->enfermedadRepository()->get();
        return response()->json($list, 200);
       
    }
    public function findByCode($codigo)
    {
        $enfermedad = $this->enfermedadRepository()->where('codigo',$codigo)->first();
        return response()->json($enfermedad, 200); 
    }
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enfermedad = $this->enfermedadRepository()->insert(
            ['codigo' => $request->codigo, 'descripcion' =>  $request->descripcion, 'negocioId' =>  $request->negocioId,'nombre' =>  $request->nombre, 'active' => true]
        );
        return response()->json($enfermedad, 201); 
    }

    public function desabilitar($codigo)
    {
        $enfermedad = $this->enfermedadRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($enfermedad, 200); 
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
        $enfermedad = $this->enfermedadRepository()
              ->where('codigo', $codigo)
              ->update(['descripcion' =>  $request->descripcion, 'negocioId' =>  $request->negocioId,'nombre' =>  $request->nombre]);

        return response()->json($enfermedad, 200); 
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
