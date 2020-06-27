<?php

namespace Modules\Animal\Imports;

use Modules\Animal\Entities;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Modules\Finca\Repositories\FincaRepository;
use Modules\Lote\Repositories\LoteRepository;

class AnimalImport implements ToModel, WithHeadingRow ,WithValidation


{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $finca=FincaRepository::all()->where('nombre','=',$row['finca']);
        $finca_id=null;
        $lote_id=null;
        if (empty($finca)){
            $finca=[
                'nombre'=>$row['finca'],
                'numero'=>1,
                'negocio_id'=>1,
                'active'=>true
            ];
           $fincanueva= FincaRepository::create($finca);
           $finca_id=$fincanueva->id;
           $lote=[
               'lote_id'=>1,
               'numero'=>$row['lote'],
               'nombre'=>"lote",
               'active'=>true,
               'finca_id'=>$finca_id
           ];
           $lotenuevo=LoteRepository::create($lote);
           $lote_id=$lotenuevo->id;
        }

        $lote=LoteRepository::all()->where('numero','=',$row['lote'])->where('finca_id','=',$finca_id);
        if (empty($lote)){
            $lote=[
                'lote_id'=>1,
                'numero'=>$row['lote'],
                'nombre'=>"lote",
                'active'=>true,
                'finca_id'=>$finca_id
            ];
            $lote=LoteRepository::create($lote);
            $lote_id=$lote->id;
        }


        return new Entities\Animal([
            'code' => $row['animal'],
            'sexo' => $row['sexo'],
            'edad' => $row['edad'],
            'fecha_nacimiento' => $row['fecha_de_nacimiento'],
            'madre_codigo' => $row['madre'],
            'padre_codigo' => 0,
            'raza_codigo' => 0,
            'lote_nacimiento_id'=>$lote_id,
            'lote_actual_id'=>$lote_id,
            'locomocion_code'=>0,
            'inventario_id'=>0,
            'temporal_id'=>0,
            'active'=>true,

        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        // TODO: Implement rules() method.
        return [];
    }
}
