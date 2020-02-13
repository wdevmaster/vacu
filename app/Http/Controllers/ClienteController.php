<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->clienteRepository()->get();
        return response()->json($list, 200);
       
    }
    public function findByCode($codigo)
    {
        $cliente = $this->clienteRepository()->where('codigo',$codigo)->first();
        return response()->json($cliente, 200); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = $this->clienteRepository()->insert(
            ['codigo' => $request->codigo, 'descripcion' =>  $request->descripcion, 'negocioId' =>  $request->negocioId, 'nombre' =>  $request->nombre, 'telf' => $request->telf, 'active' => true]
        );
        return response()->json($cliente, 201); 
    }

    public function desabilitar($codigo)
    {
        $cliente = $this->clienteRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($cliente, 200); 
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
        $cliente = $this->clienteRepository()
              ->where('codigo', $codigo)
              ->update(['descripcion' =>  $request->descripcion, 'negocioId' =>  $request->negocioId, 'nombre' =>  $request->nombre, 'telf' => $request->telf]);

        return response()->json($cliente, 200); 
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
