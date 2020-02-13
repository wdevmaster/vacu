<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RazaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->razaRepository()->get();
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
        $raza = $this->razaRepository()->insert(
            ['codigo' => $request->codigo, 'negocioId' =>  $request->negocioId, 'nombre' =>  $request->nombre, 'active' => true]
        );
        return response()->json($raza, 201); 
    }

    public function desabilitar($codigo)
    {
        $raza = $this->razaRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($raza, 200); 
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
        $raza = $this->razaRepository()
              ->where('codigo', $codigo)
              ->update(['negocioId' =>  $request->negocioId, 'nombre' =>  $request->nombre]);

        return response()->json($raza, 200); 
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
