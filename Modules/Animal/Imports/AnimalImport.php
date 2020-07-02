<?php

namespace Modules\Animal\Imports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Modules\Animal\Entities;
use Modules\Finca\Entities\Finca;
use Modules\Lote\Entities\Lote;
use Modules\Parto\Entities\Parto;
use Modules\Raza\Entities\Raza;


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
        $finca = Finca::all()->where('nombre', '=', $row['finca'])->where('negocio_id', '=', $this->negocio_id);
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
        if ($row['sexo'] == 'Hembra'){
            if($row['prenez'] == 'S') {
                $estado_id = Entities\Estado::where('nombre', 'Palpada Positiva')->first()->id;
            }

            if($row['prenez'] == 'N') {
                $estado_id = Entities\Estado::where('nombre', 'Palpada Negativa')->first()->id;
            }
        }

        $raza_code = null;
        is_null($row['raza']) ? $raza_code = null : $raza_code = Raza::where('nombre', $row['raza'])->first()->code;

        $cant_partos = 0;
        is_null($row['partos']) ? $cant_partos = 0 : $cant_partos = $row['partos'];
        for ($i = 0; $i < $cant_partos; $i++) {
            $data = [
                'code' => Parto::generarCodigo(),
                'madre_code' => $row['animal'],
                'positivo' => true,
            ];
            Parto::create($data);
        }

        $cant_partos_negativos = 0;
        is_null($row['partos_muertos']) ? $cant_partos_negativos = 0 : $cant_partos_negativos = $row['partos_muertos'];
        for ($i = 0; $i < $cant_partos_negativos; $i++) {
           $data = [
                'code' => Parto::generarCodigo(),
                'madre_code' => $row['animal'],
                'positivo' => false,
            ];
            Parto::create($data);
        }
        $date = null;
        if ($row['fecha_de_nacimiento'])
        $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_de_nacimiento']);

        return new Entities\Animal([
            'code' => $row['animal'],
            'sexo' => $row['sexo'],
            'estado_id' => $estado_id,
            'fecha_nacimiento' => $date,
            'madre_codigo' => $row['madre'],
            'padre_codigo' => 0,
            'raza_codigo' => $raza_code,
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
