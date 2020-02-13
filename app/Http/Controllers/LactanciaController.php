<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LactanciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->lactanciaRepository()->get();
        return response()->json($list, 200);
        
    }
    public function findByCode($codigo)
    {
        $lactancia = $this->lactanciaRepository()->where('codigo',$codigo)->first();
        return response()->json($lactancia, 200); 
    }

    public function lactanciaByAnimal($animal)
    {
        $lactancias = $this->lactanciaRepository()->where('animal_codigo',$animal)->get();;
        return response()->json($lactancias, 200); 
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lactancia = $this->lactanciaRepository()->insert(
            ['codigo' => $request->codigo, 'animal_codigo' =>  $request->animal_codigo, 'concentrado' =>  $request->concentrado,'fecha' =>  $request->fecha, 'leche' => $request->leche, 'peso' => $request->peso, 'active' => true]
        );
        return response()->json($lactancia, 201); 
    }
  
    public function desabilitar($codigo)
    {
        $lactancia = $this->lactanciaRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($lactancia, 200); 
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
        $lactancia = $this->lactanciaRepository()
              ->where('codigo', $codigo)
              ->update(['animal_codigo' =>  $request->animal_codigo, 'concentrado' =>  $request->concentrado,'fecha' =>  $request->fecha, 'leche' => $request->leche, 'peso' => $request->peso]);

        return response()->json($lactancia, 200); 
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
