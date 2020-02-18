<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->ingresoRepository()->get();
        return response()->json($list, 200);
    }
    public function list($negocio)
    {        
        $list = $this->ingresoRepository()
        ->join('animal', 'ingreso.animal_codigo', '=', 'animal.codigo')
        ->join('lote', 'animal.lote_actual_Id', '=', 'lote.idLote')
        ->join('finca', 'lote.fincaId', '=', 'finca.idfinca')
        ->where('negocioId',$negocio)->where('active',true)->get();
        return response()->json($list, 200);
    }

    public function findByCode($codigo)
    {
        $ingreso = $this->ingresoRepository()->where('codigo',$codigo)->first();
        return response()->json($ingreso, 200); 
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

        $ingreso = $this->ingresoRepository()->insert(
            ['codigo' =>  $code, 'animal_codigo' =>  $animal, 'fecha' =>  $request->fecha,'loteId' =>  $request->loteId, 'active' => true]
        );
        return response()->json($ingreso, 201); 
    }

    public function inactivar($codigo)
    {
        $ingreso = $this->ingresoRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($ingreso, 200); 
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
        $ingreso = $this->ingresoRepository()
              ->where('codigo', $codigo)
              ->update(['animal_codigo' =>  $request->animal_codigo, 'fecha' =>  $request->fecha,'loteId' =>  $request->loteId]);

        return response()->json($ingreso, 200); 
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
        if($this->ingresoRepository()->where('codigo', $codigo)->exists())
        {
         $last = $this->ingresoRepository()->orderby('codigo','DESC')->first();
         $new_code = $last->codigo + 1;
         $this->sincronizacionRepository()->insert(
            ['codigo_actual' => $new_code, 'codigo_remoto' =>  $codigo, 'tabla' =>  'ingreso']
        );  
            return $new_code;
        }
        else
        {
            return $codigo;
        }
    }
}
