<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CondicionCorporalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->condicionCorporalRepository()->get();
        return response()->json($list, 200);
       
    }
    public function findByCode($codigo)
    {
        $condicion = $this->condicionCorporalRepository()->where('codigo',$codigo)->first();
        return response()->json($condicion, 200); 
    }
 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $condicion = $this->condicionCorporalRepository()->insert(
            ['codigo' => $request->codigo, 'descripcion' =>  $request->descripcion, 'negocioId' =>  $request->negocioId,'nombre' =>  $request->nombre, 'active' => true]
        );
        return response()->json($condicion, 201); 
    }

    public function desabilitar($codigo)
    {
        $condicion = $this->condicionCorporalRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($condicion, 200); 
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
        $condicion = $this->negocioRepository()
              ->where('idNegocio', $id)
              ->update(['descripcion' =>  $request->descripcion, 'negocioId' =>  $request->negocioId,'nombre' =>  $request->nombre]);

        return response()->json($condicion, 200); 
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
