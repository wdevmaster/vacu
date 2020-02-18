<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InseminadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->inseminadorRepository()->get();
        return response()->json($list, 200);
    }
    public function list($negocio)
    {        
        $list = $this->inseminadorRepository()
        ->where('negocioId',$negocio)->where('active',true)->get();
        return response()->json($list, 200);
    }
    public function findByCode($codigo)
    {
        $inseminador = $this->inseminadorRepository()->where('codigo',$codigo)->first();
        return response()->json($inseminador, 200); 
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
        $inseminador = $this->inseminadorRepository()->insert(
            ['codigo' => $code, 'negocioId' =>  $request->negocioId, 'nombre' =>  $request->nombre, 'active' => true]
        );
        return response()->json($inseminador, 201); 
    }

    public function inactivar($codigo)
    {
        $inseminador = $this->inseminadorRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($inseminador, 200); 
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
        $aniinseminadormal = $this->inseminadorRepository()
              ->where('codigo', $codigo)
              ->update(['negocioId' =>  $request->negocioId, 'nombre' =>  $request->nombre]);

        return response()->json($inseminador, 200); 
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
        if($this->inseminadorRepository()->where('codigo', $codigo)->exists())
        {
         $last = $this->inseminadorRepository()->orderby('codigo','DESC')->first();
         $new_code = $last->codigo + 1;
         $this->sincronizacionRepository()->insert(
            ['codigo_actual' => $new_code, 'codigo_remoto' =>  $codigo, 'tabla' =>  'inseminador']
        );  
            return $new_code;
        }
        else
        {
            return $codigo;
        }
    }
}
