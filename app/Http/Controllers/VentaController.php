<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->ventaRepository()->get();
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
        $venta = $this->ventaRepository()->insert(
            ['codigo' => $request->codigo, 'animal_codigo' =>  $request->animal_codigo, 'cliente_codigo' =>  $request->cliente_codigo,'fecha' =>  $request->fecha, 'motivo' => $request->motivo, 'active' => true]
        );
        return response()->json($venta, 201); 
    }

    public function desabilitar($codigo)
    {
        $venta = $this->ventaRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($venta, 200); 
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
        $venta = $this->ventaRepository()
              ->where('codigo', $codigo)
              ->update(['animal_codigo' =>  $request->animal_codigo, 'cliente_codigo' =>  $request->cliente_codigo,'fecha' =>  $request->fecha, 'motivo' => $request->motivo]);

        return response()->json($venta, 200); 
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
