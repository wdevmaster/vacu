<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MuerteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->muerteRepository()->get();
        return response()->json($list, 200);
    }
    public function findByCode($codigo)
    {
        $muerte = $this->muerteRepository()->where('codigo',$codigo)->first();
        return response()->json($muerte, 200); 
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

        $muerte = $this->muerteRepository()->insert(
            ['codigo' => $code, 'animal_codigo' =>  $animal, 'fecha' =>  $request->fecha,'motivoId' =>  $request->motivoId]
        );
        return response()->json($muerte, 201); 
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
        $muerte = $this->muerteRepository()
              ->where('codigo', $codigo)
              ->update(['animal_codigo' =>  $request->animal_codigo, 'fecha' =>  $request->fecha,'motivoId' =>  $request->motivoId]);

        return response()->json($muerte, 200); 
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
        if($this->muerteRepository()->where('codigo', $codigo)->exists())
        {
         $last = $this->muerteRepository()->orderby('codigo','DESC')->first();
         $new_code = $last->codigo + 1;
         $this->sincronizacionRepository()->insert(
            ['codigo_actual' => $new_code, 'codigo_remoto' =>  $codigo, 'tabla' =>  'muerte']
        );  
            return $new_code;
        }
        else
        {
            return $codigo;
        }
    }
}
