<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->partoRepository()->get();
        return response()->json($list, 200);
    }

    public function findByCode($codigo)
    {
        $parto = $this->partoRepository()->where('codigo',$codigo)->first();
        return response()->json($parto, 200); 
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parto = $this->partoRepository()->insert(
            ['codigo' => $request->codigo, 'animal_nacido' =>  $request->animal_nacido, 'fecha' =>  $request->fecha,'madre_codigo' =>  $request->madre_codigo, 'raza_codigo' => $request->raza_codigo, 'sexo' => $request->sexo, 'active' => true]
        );
        return response()->json($parto, 201); 
    }

    public function desabilitar($codigo)
    {
        $parto = $this->partoRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($parto, 200); 
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
        $parto = $this->partoRepository()
              ->where('codigo', $codigo)
              ->update(['animal_nacido' =>  $request->animal_nacido, 'fecha' =>  $request->fecha,'madre_codigo' =>  $request->madre_codigo, 'raza_codigo' => $request->raza_codigo, 'sexo' => $request->sexo]);

        return response()->json($parto, 200); 
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
