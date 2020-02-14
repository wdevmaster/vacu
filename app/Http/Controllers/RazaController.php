<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RazaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->razaRepository()->get();
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
        $raza = $this->razaRepository()->insert(
            ['codigo' => $code, 'negocioId' =>  $request->negocioId, 'nombre' =>  $request->nombre, 'active' => true]
        );
        return response()->json($raza, 201); 
    }

    public function desabilitar($codigo)
    {
        $raza = $this->razaRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($raza, 200); 
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
        $raza = $this->razaRepository()
              ->where('codigo', $codigo)
              ->update(['negocioId' =>  $request->negocioId, 'nombre' =>  $request->nombre]);

        return response()->json($raza, 200); 
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
        if($this->razaRepository()->where('codigo', $codigo)->exists())
        {
         $last = $this->razaRepository()->orderby('codigo','DESC')->first();
         $new_code = $last->codigo + 1;
         $this->sincronizacionRepository()->insert(
            ['codigo_actual' => $new_code, 'codigo_remoto' =>  $codigo, 'tabla' =>  'raza']
        );  
            return $new_code;
        }
        else
        {
            return $codigo;
        }
    }
}
