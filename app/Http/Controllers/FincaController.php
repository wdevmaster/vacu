<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FincaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $list = $this->fincaRepository()->get();
        return response()->json($list, 200);     
    }
    public function list($negocio)
    {        
        $list = $this->fincaRepository()
        ->where('negocioId',$negocio)->where('active',true)->get();
        return response()->json($list, 200);
    }
    public function findById($id)
    {
        $finca = $this->fincaRepository()->where('idfinca',$id)->first();
        return response()->json($finca, 200); 
    }
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $finca = $this->fincaRepository()->insert(
            ['nombre' => $request->nombre, 'numero' =>  $request->numero, 'negocioId' =>  $request->negocioId, 'active' => true]
        );
        return response()->json($finca, 201); 
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
        $finca = $this->fincaRepository()
              ->where('idfinca', $id)
              ->update(['nombre' => $request->nombre, 'numero' =>  $request->numero, 'negocioId' =>  $request->negocioId]);

        return response()->json($finca, 200); 
    }

    public function desabilitar($id)
    {
        $finca = $this->fincaRepository()
              ->where('idfinca', $id)
              ->update(['active' => false]);

        return response()->json($finca, 200); 
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
