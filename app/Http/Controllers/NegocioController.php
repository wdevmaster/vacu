<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NegocioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->negocioRepository()->get();
        return response()->json($list, 200);
    }

    public function findById($id)
    {
        $negocio = $this->negocioRepository()->where('idNegocio',$id)->first();
        return response()->json($negocio, 200); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $negocio = $this->negocioRepository()->insert(
            ['jefe' => $request->jefe, 'nombre' =>  $request->nombre, 'telf' =>  $request->telf, 'active' => true]
        );
        return response()->json($negocio, 201); 
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
        $negocio = $this->negocioRepository()
              ->where('idNegocio', $id)
              ->update(['jefe' => $request->jefe, 'nombre' =>  $request->nombre, 'telf' =>  $request->telf]);

        return response()->json($negocio, 200); 
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
