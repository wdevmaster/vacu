<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->loteRepository()->get();
        return response()->json($list, 200);
    }
    public function list($negocio)
    {        
        $list = $this->loteRepository()
        ->join('finca', 'lote.fincaId', '=', 'finca.idfinca')
        ->where('negocioId',$negocio)->where('active',true)->get();
        return response()->json($list, 200);
    }

    public function findById($id)
    {
        $lote = $this->loteRepository()->where('idLote',$id)->first();
        return response()->json($lote, 200); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lote = $this->loteRepository()->insert(
            ['nombre' =>  $request->nombre, 'numero' => $request->numero, 'fincaId' =>  $request->fincaId, 'active' => true]
        );
        return response()->json($lote, 201); 
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
        $lote = $this->loteRepository()
              ->where('idLote', $id)
              ->update( ['nombre' =>  $request->nombre, 'numero' => $request->numero, 'fincaId' =>  $request->fincaId]);

        return response()->json($lote, 200); 
    }

    public function desabilitar($id)
    {
        $lote = $this->loteRepository()
              ->where('idLote', $id)
              ->update(['active' => false]);

        return response()->json($lote, 200); 
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
}
