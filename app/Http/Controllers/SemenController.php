<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->semenRepository()->get();
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
        $semen = $this->semenRepository()->insert(
            ['codigo' => $request->codigo, 'animal_codigo' =>  $request->animal_codigo, 'active' => true]
        );
        return response()->json($semen, 201); 
    }

    public function desabilitar($codigo)
    {
        $semen = $this->semenRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($semen, 200); 
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
        $semen = $this->semenRepository()
              ->where('codigo', $codigo)
              ->update(['animal_codigo' =>  $request->animal_codigo]);

        return response()->json($semen, 200); 
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
