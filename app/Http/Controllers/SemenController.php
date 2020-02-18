<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->semenRepository()->get();
        return response()->json($list, 200);
    }
    public function list($negocio)
    {        
        $list = $this->semenRepository()
        ->join('animal', 'semen.animal_codigo', '=', 'animal.codigo')
        ->join('lote', 'animal.lote_actual_Id', '=', 'lote.idLote')
        ->join('finca', 'lote.fincaId', '=', 'finca.idfinca')
        ->where('negocioId',$negocio)->where('active',true)->get();
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

        $semen = $this->semenRepository()->insert(
            ['codigo' => $code, 'animal_codigo' =>  $animal, 'active' => true]
        );
        return response()->json($semen, 201); 
    }

    public function desabilitar($codigo)
    {
        $semen = $this->semenRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($semen, 200); 
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
        $semen = $this->semenRepository()
              ->where('codigo', $codigo)
              ->update(['animal_codigo' =>  $request->animal_codigo]);

        return response()->json($semen, 200); 
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
        if($this->semenRepository()->where('codigo', $codigo)->exists())
        {
         $last = $this->semenRepository()->orderby('codigo','DESC')->first();
         $new_code = $last->codigo + 1;
         $this->sincronizacionRepository()->insert(
            ['codigo_actual' => $new_code, 'codigo_remoto' =>  $codigo, 'tabla' =>  'semen']
        );  
            return $new_code;
        }
        else
        {
            return $codigo;
        }
    }
}
