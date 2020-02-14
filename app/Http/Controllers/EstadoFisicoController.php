<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstadoFisicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->estadoFisicoRepository()->get();
        return response()->json($list, 200);
    }

    public function findByCode($codigo)
    {
        $estado = $this->estadoFisicoRepository()->where('codigo',$codigo)->first();
        return response()->json($estado, 200); 
    }

    public function estadosByAnimal($animal)
    {
        $estados = $this->estadoFisicoRepository()->where('animal_codigo',$animal)->get();;
        return response()->json($estados, 200); 
    }
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $code = $this->getCode($request->codigo);
        $condicion = $this->verifyCode('condicion_corporal', $request->condicion_corporal_codigo);
        $locomocion = $this->verifyCode('locomocion', $request->locomocion_codigo);
        $animal = $this->verifyCode('animal', $request->animal_codigo);

        $estado = $this->estadoFisicoRepository()->insert(
            ['codigo' =>  $code, 'animal_codigo' =>  $animal, 'condicion_corporal_codigo' =>  $condicion, 'fecha' =>  $request->fecha, 'locomocion_codigo' => $locomocion, 'active' => true]
        );
        return response()->json($estado, 201); 
    }

    public function desabilitar($codigo)
    {
        $estado = $this->estadoFisicoRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($estado, 200); 
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
        //
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

    private function getCode($codigo)
    {
        if($this->estadoFisicoRepository()->where('codigo', $codigo)->exists())
        {
         $last = $this->estadoFisicoRepository()->orderby('codigo','DESC')->first();
         $new_code = $last->codigo + 1;
         $this->sincronizacionRepository()->insert(
            ['codigo_actual' => $new_code, 'codigo_remoto' =>  $codigo, 'tabla' =>  'estado_fisico']
        );  
            return $new_code;
        }
        else
        {
            return $codigo;
        }
    }
}
