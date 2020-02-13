<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProduccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->produccionRepository()->get();
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
        $prod = $this->produccionRepository()->insert(
            ['codigo' => $request->codigo, 'animal_codigo' =>  $request->animal_codigo, 'fecha' =>  $request->fecha,'peso' =>  $request->peso, 'active' => true]
        );
        return response()->json($prod, 201); 
    }

    public function desabilitar($codigo)
    {
        $prod = $this->produccionRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($prod, 200); 
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
        $prod = $this->produccionRepository()
              ->where('codigo', $codigo)
              ->update(['animal_codigo' =>  $request->animal_codigo, 'fecha' =>  $request->fecha,'peso' =>  $request->peso]);

        return response()->json($prod, 200); 
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
