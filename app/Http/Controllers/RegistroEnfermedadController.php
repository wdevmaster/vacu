<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroEnfermedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->registroEnfermedadRepository()->get();
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
        $code = $this->getCode($request->codigo);
        $animal = $this->verifyCode('animal', $request->animal_codigo);
        $enfermedad = $this->verifyCode('enfermedad', $request->enfermedad_codigo);
        
        $registro = $this->registroEnfermedadRepository()->insert(
            ['codigo' => $code, 'animal_codigo' =>  $animal, 'enfermedad_codigo' =>  $enfermedad,'fecha' =>  $request->fecha, 'active' => true]
        );
        return response()->json($registro, 201); 
    }

    public function desabilitar($codigo)
    {
        $registro = $this->registroEnfermedadRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($registro, 200); 
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
        $registro = $this->registroEnfermedadRepository()
              ->where('codigo', $codigo)
              ->update(['animal_codigo' =>  $request->animal_codigo, 'enfermedad_codigo' =>  $request->enfermedad_codigo,'fecha' =>  $request->fecha]);

        return response()->json($registro, 200); 
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
        if($this->registroEnfermedadRepository()->where('codigo', $codigo)->exists())
        {
         $last = $this->registroEnfermedadRepository()->orderby('codigo','DESC')->first();
         $new_code = $last->codigo + 1;
         $this->sincronizacionRepository()->insert(
            ['codigo_actual' => $new_code, 'codigo_remoto' =>  $codigo, 'tabla' =>  'registro_enfermedad']
        );  
            return $new_code;
        }
        else
        {
            return $codigo;
        }
    }
}
