<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->configuracionRepository()->get();
        return response()->json($list, 200);
    }

    public function sincronizar(Request $request)
    {
        return response()->json($this->Sincronizar($request->token), 200);
    }

    public function desconectar()
    {
        return response()->json($this->Desconectar(), 200);
    }

    public function getRoles()
    {
        $list = $this->rolRepository()->get();
        return response()->json($list, 200);
    }

    public function findByKey($key)
    {
        $value = $this->configuracionRepository()->where('clave',$key)->value('valor');
        return response()->json($value, 200); 
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $config = $this->configuracionRepository()->insert(
            ['clave' => $request->clave, 'descripcion' =>  $request->descripcion, 'valor' =>  $request->valor]
        );
        return response()->json($config, 201); 
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
        $config = $this->configuracionRepository()
              ->where('idconfiguracion', $id)
              ->update(['clave' => $request->clave, 'descripcion' =>  $request->descripcion, 'valor' =>  $request->valor]);

        return response()->json($config, 200); 
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
