<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocomocionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->locomocionRepository()->get();
        return response()->json($list, 200);
        
    }
    public function list($negocio)
    {        
        $list = $this->locomocionRepository()
        ->where('negocioId',$negocio)->where('active',true)->get();
        return response()->json($list, 200);
    }
    public function findByCode($codigo)
    {
        $locomocion = $this->locomocionRepository()->where('codigo',$codigo)->first();
        return response()->json($locomocion, 200); 
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
        $locomocion = $this->locomocionRepository()->insert(
            ['codigo' => $code, 'descripcion' =>  $request->descripcion, 'negocioId' =>  $request->negocioId,'nombre' =>  $request->nombre, 'active' => true]
        );
        return response()->json($locomocion, 201); 
    }

    public function inactivar($codigo)
    {
        $locomocion = $this->locomocionRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($locomocion, 200); 
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
        $locomocion = $this->locomocionRepository()
              ->where('codigo', $codigo)
              ->update(['descripcion' =>  $request->descripcion, 'negocioId' =>  $request->negocioId,'nombre' =>  $request->nombre]);

        return response()->json($locomocion, 200); 
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
        if($this->locomocionRepository()->where('codigo', $codigo)->exists())
        {
         $last = $this->locomocionRepository()->orderby('codigo','DESC')->first();
         $new_code = $last->codigo + 1;
         $this->sincronizacionRepository()->insert(
            ['codigo_actual' => $new_code, 'codigo_remoto' =>  $codigo, 'tabla' =>  'locomocion']
        );  
            return $new_code;
        }
        else
        {
            return $codigo;
        }
    }
}
