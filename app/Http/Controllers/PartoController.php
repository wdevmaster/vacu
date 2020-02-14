<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->partoRepository()->get();
        return response()->json($list, 200);
    }

    public function findByCode($codigo)
    {
        $parto = $this->partoRepository()->where('codigo',$codigo)->first();
        return response()->json($parto, 200); 
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
        $animalNacido = $this->verifyCode('animal', $request->animal_nacido);
        $madre = $this->verifyCode('animal', $request->madre_codigo);
        $raza = $this->verifyCode('raza', $request->raza_codigo);

        $parto = $this->partoRepository()->insert(
            ['codigo' => $code, 'animal_nacido' =>  $animalNacido, 'fecha' =>  $request->fecha,'madre_codigo' =>  $madre, 'raza_codigo' => $raza, 'sexo' => $request->sexo, 'active' => true]
        );
        return response()->json($parto, 201); 
    }

    public function desabilitar($codigo)
    {
        $parto = $this->partoRepository()
              ->where('codigo', $codigo)
              ->update(['active' => false]);

        return response()->json($parto, 200); 
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
        $parto = $this->partoRepository()
              ->where('codigo', $codigo)
              ->update(['animal_nacido' =>  $request->animal_nacido, 'fecha' =>  $request->fecha,'madre_codigo' =>  $request->madre_codigo, 'raza_codigo' => $request->raza_codigo, 'sexo' => $request->sexo]);

        return response()->json($parto, 200); 
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
        if($this->partoRepository()->where('codigo', $codigo)->exists())
        {
         $last = $this->partoRepository()->orderby('codigo','DESC')->first();
         $new_code = $last->codigo + 1;
         $this->sincronizacionRepository()->insert(
            ['codigo_actual' => $new_code, 'codigo_remoto' =>  $codigo, 'tabla' =>  'parto']
        );  
            return $new_code;
        }
        else
        {
            return $codigo;
        }
    }
}
