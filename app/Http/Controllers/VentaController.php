<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->ventaRepository()->get();
        return response()->json($list, 200);
    }

    public function list($negocio)
    {        
        $list = $this->ventaRepository()
        ->join('animal', 'venta.animal_codigo', '=', 'animal.codigo')
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
        $cliente = $this->verifyCode('cliente', $request->cliente_codigo);

        $venta = $this->ventaRepository()->insert(
            ['codigo' => $code, 'animal_codigo' =>  $animal, 'cliente_codigo' =>  $cliente,'fecha' =>  $request->fecha, 'motivo' => $request->motivo, 'active' => true]
        );
        return response()->json($venta, 201); 
    }

    public function inactivar($codigo)
    {
        $venta = $this->ventaRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($venta, 200); 
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
        $venta = $this->ventaRepository()
              ->where('codigo', $codigo)
              ->update(['animal_codigo' =>  $request->animal_codigo, 'cliente_codigo' =>  $request->cliente_codigo,'fecha' =>  $request->fecha, 'motivo' => $request->motivo]);

        return response()->json($venta, 200); 
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
        if($this->ventaRepository()->where('codigo', $codigo)->exists())
        {
         $last = $this->ventaRepository()->orderby('codigo','DESC')->first();
         $new_code = $last->codigo + 1;
         $this->sincronizacionRepository()->insert(
            ['codigo_actual' => $new_code, 'codigo_remoto' =>  $codigo, 'tabla' =>  'venta']
        );  
            return $new_code;
        }
        else
        {
            return $codigo;
        }
    }
}
