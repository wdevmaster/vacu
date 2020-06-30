<?php

namespace Modules\Animal\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Modules\Animal\Entities;
use Modules\Finca\Entities\Finca;
use Modules\Lote\Entities\Lote;


class AnimalImport implements ToModel, WithHeadingRow, WithValidation


{
    private $negocio_id;

    public function __construct($negocio_id)
    {
        $this->negocio_id = $negocio_id;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $finca_id = null;
        $lote_id = null;
        $finca = Finca::all()->where('nombre', '=', $row['finca'])->where('negocio_id','=',$this->negocio_id);
        if ($finca->count() == 0) {
            $finca = [
                'nombre' => $row['finca'],
                'negocio_id' => $this->negocio_id,
                'active' => true
            ];
            $fincanueva = Finca::create($finca);
            $finca_id = $fincanueva->id;
            $lote = [
                'nombre' => $row['lote'],
                'active' => true,
                'finca_id' => $finca_id
            ];
            $lotenuevo = Lote::create($lote);
            $lote_id = $lotenuevo->id;
        } else {
            $finca_id = $finca[0]->id;
        }

        $lote = Lote::all()->where('nombre', '=', $row['lote'])->where('finca_id', '=', $finca_id);
        if ($lote->count() == 0) {
            $lote = [
                'nombre' => $row['lote'],
                'active' => true,
                'finca_id' => $finca_id
            ];
            $lote = Lote::create($lote);
            $lote_id = $lote->id;
        } else {
            $lote_id = $lote[0]->id;
        }

        $estado_id = null;
        is_null($row['prenez']) ? $estado_id = null : $estado_id = Entities\Estado::where('nombre', 'Palpada Positiva')->first()->id;
        return new Entities\Animal([
            'code' => $row['animal'],
            'sexo' => $row['sexo'],
            'estado_id' => $estado_id,
            'fecha_nacimiento' => $row['fecha_de_nacimiento'],
            'madre_codigo' => $row['madre'],
            'padre_codigo' => 0,
            'raza_codigo' => 0,
            'lote_nacimiento_id' => $lote_id,
            'lote_actual_id' => $lote_id,
            'locomocion_code' => 0,
            'inventario_id' => 0,
            'temporal_id' => 0,
            'active' => true,

        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
       return [];
    }
}
