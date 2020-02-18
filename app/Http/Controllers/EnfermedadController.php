<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnfermedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->enfermedadRepository()->get();
        return response()->json($list, 200);
       
    }
    public function list($negocio)
    {        
        $list = $this->enfermedadRepository()
        ->where('negocioId',$negocio)->where('active',true)->get();
        return response()->json($list, 200);
    }
    public function findByCode($codigo)
    {
        $enfermedad = $this->enfermedadRepository()->where('codigo',$codigo)->first();
        return response()->json($enfermedad, 200); 
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
        $enfermedad = $this->enfermedadRepository()->insert(
            ['codigo' => $code, 'descripcion' =>  $request->descripcion, 'negocioId' =>  $request->negocioId,'nombre' =>  $request->nombre, 'active' => true]
        );
        return response()->json($enfermedad, 201); 
    }

    public function inactivar($codigo)
    {
        $enfermedad = $this->enfermedadRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($enfermedad, 200); 
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
        $enfermedad = $this->enfermedadRepository()
              ->where('codigo', $codigo)
              ->update(['descripcion' =>  $request->descripcion, 'negocioId' =>  $request->negocioId,'nombre' =>  $request->nombre]);

        return response()->json($enfermedad, 200); 
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
        if($this->enfermedadRepository()->where('codigo', $codigo)->exists())
        {
         $last = $this->enfermedadRepository()->orderby('codigo','DESC')->first();
         $new_code = $last->codigo + 1;
         $this->sincronizacionRepository()->insert(
            ['codigo_actual' => $new_code, 'codigo_remoto' =>  $codigo, 'tabla' =>  'enfermedad']
        );  
            return $new_code;
        }
        else
        {
            return $codigo;
        }
    }
}
