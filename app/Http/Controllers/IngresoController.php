<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->ingresoRepository()->get();
        return response()->json($list, 200);
    }

    public function findByCode($codigo)
    {
        $ingreso = $this->ingresoRepository()->where('codigo',$codigo)->first();
        return response()->json($ingreso, 200); 
    }
 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ingreso = $this->ingresoRepository()->insert(
            ['codigo' => $request->codigo, 'animal_codigo' =>  $request->animal_codigo, 'fecha' =>  $request->fecha,'loteId' =>  $request->loteId, 'active' => true]
        );
        return response()->json($ingreso, 201); 
    }

    public function desabilitar($codigo)
    {
        $ingreso = $this->ingresoRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($ingreso, 200); 
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
        $ingreso = $this->ingresoRepository()
              ->where('codigo', $codigo)
              ->update(['animal_codigo' =>  $request->animal_codigo, 'fecha' =>  $request->fecha,'loteId' =>  $request->loteId]);

        return response()->json($ingreso, 200); 
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
