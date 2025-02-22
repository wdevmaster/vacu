<?php

namespace Modules\Animal\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Modules\Animal\Entities;
use Modules\Finca\Entities\Finca;
use Modules\Lote\Entities\Lote;
use Modules\Negocio\Entities\Negocio;
use Modules\Parto\Entities\Parto;
use Modules\Raza\Entities\Raza;
use Modules\Animal\Entities\TipoProduccion;



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
        $negocio= Negocio::all()->where('id','=',$this->negocio_id);
        $fecha_creacion = $negocio->first()->fecha_creacion;
        $finca_id = null;
        $lote_id = null;
        $finca = Finca::all()->where('nombre', '=', $row['finca'])->where('negocio_id', '=', $this->negocio_id);
        if ($finca->count() == 0) {
            $finca_all = Finca::all();
            $mayor = 0;
            foreach ($finca_all as $finc){
                if ($finc->code > $mayor){
                    $mayor = $finc->code;
                }
            }
            $mayor = $mayor + 1;
            $finca_data = [
                'code'=>$mayor,
                'nombre' => $row['finca'],
                'negocio_id' => $this->negocio_id,
                'active' => true
            ];
            $fincanueva = Finca::create($finca_data);
            $finca_id = $fincanueva->code;
            $lote_all = Lote::all();
            $mayorLote = 0;
            foreach ($lote_all as $lote){
                if ($lote->code > $mayorLote){
                    $mayorLote = $lote->code;
                }
            }
            $mayorLote = $mayorLote + 1;

            $lote = [
                'code'=>$mayorLote,
                'nombre' => $row['lote'],
                'active' => true,
                'finca_id' => $finca_id,
                'negocio_id' => $this->negocio_id
            ];
            $lotenuevo = Lote::create($lote);
            $lote_id = $lotenuevo->code;
        } else {
            $finca_id = $finca->first()->code;
        }

        $lote_all = Lote::all();
        $mayorLote = 0;
        foreach ($lote_all as $lote){
            if ($lote->code > $mayorLote){
                $mayorLote = $lote->code;
            }
        }
        $mayorLote = $mayorLote + 1;

        $lote = Lote::all()->where('nombre', '=', $row['lote'])->where('finca_id', '=', $finca_id);
        if ($lote->count() == 0) {
            $lote = [
                'code'=>$mayorLote,
                'nombre' => $row['lote'],
                'active' => true,
                'finca_id' => $finca_id,
                'negocio_id' => $this->negocio_id
            ];
            $lote = Lote::create($lote);
            $lote_id = $lote->code;
        } else {
            $lote_id = $lote->first()->id;
        }

        $estado_id = null;
        if ($row['sexo'] == 'Hembra'){
            if($row['prenez'] == 'S' || $row['prenez'] == 's') {
                $estado_id = Entities\Estado::where('nombre', 'Palpada Positiva')->first()->id;
            }

            if($row['prenez'] == 'N' || $row['prenez']== 'n') {
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
                'fecha'=>$fecha_creacion,
                'madre_code' => $row['animal'],
                'negocio_id' => $this->negocio_id,
                'positivo' => true,
            ];
            Parto::create($data);
        }

        $cant_partos_negativos = 0;
        is_null($row['partos_muertos']) ? $cant_partos_negativos = 0 : $cant_partos_negativos = $row['partos_muertos'];
        for ($i = 0; $i < $cant_partos_negativos; $i++) {
           $data = [
                'code' => Parto::generarCodigo(),
                'fecha'=>$fecha_creacion,
                'madre_code' => $row['animal'],
                'negocio_id' => $this->negocio_id,
                'positivo' => false,
            ];
            Parto::create($data);
        }
        $date = null;
        if ($row['fecha_de_nacimiento'])
        $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_de_nacimiento']);

        $tipo_produccion=null;
        is_null($row['tipo_produccion']) ? $tipo_produccion = null : $tipo_produccion = TipoProduccion::where('nombre', $row['tipo_produccion'])->first()->id;


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
            'codigo_trabajo'=>"",
            'tipo_produccion_id'=>$tipo_produccion,
            'temporal_id' => 0,
            'negocio_id' => $this->negocio_id,
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
