<?php
/**
 * Created by IntelliJ IDEA.
 * User: roli
 * Date: 14/09/20
 * Time: 22:44
 */

namespace Modules\Animal\Exports;


use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Animal\Entities\Animal;
use Modules\Animal\Entities\Estado;
use Modules\Animal\Entities\TipoProduccion;
use Modules\Finca\Entities\Finca;
use Modules\Lote\Entities\Lote;
use Modules\Parto\Entities\Parto;
use Modules\Raza\Entities\Raza;

class AnimalExport implements FromCollection,WithHeadings
{

    use Exportable;

    private $negocio_id;

    public function __construct($negocio_id)
    {
        $this->negocio_id = $negocio_id;
    }

    /**
     * @return Collection
     */
    public function collection()
    {

        $animales=Animal::all()->where('negocio_id','=',$this->negocio_id);

        $animalCollection=new Collection();

        foreach ($animales as $animal){

            $raza= Raza::all()->where('code','=',$animal->raza_codigo)->first()->nombre;
            $prenne='';
            $estado= Estado::all()->where('id','=',$animal->estado_id)->first();
            $tipo_produccion=TipoProduccion::all()->where('id','=',$animal->tipo_produccion_id)->first();
            $produccion='';
            if ($tipo_produccion){
                $produccion=$tipo_produccion->nombre;
            }

            if (!empty($estado)) {
                if ($estado->nombre == 'Palpada Positiva') {
                    $prenne = 'S';
                }

                if ($estado->nombre == 'Palpada Negativa') {
                    $prenne = 'N';
                }
            }

            $partos=Parto::all()->where('madre_code','=',$animal->code);
            $partosNegativos=Parto::all()->where('madre_code','=',$animal->code)->where('positivo','=',false);

            $lote=Lote::all()->where('code','=',$animal->lote_actual_id)->first();

            $finca=Finca::all()->where('code','=',$lote->finca_id)->first();

            $fechaNacimiento=$animal->fecha_nacimiento->toDateTimeString();

            $data=[];
            $data['FECHA REVISION']= Carbon::now()->format('Y-m-d');
            $data['ANIMAL']=$animal->code;
            $data['SEXO']=$animal->sexo;
            $data['EDAD']='';
            $data['RAZA']=$raza;
            $data['PREÑEZ']=$prenne;
            $data['PARTOS']=count($partos->toArray());
            $data['MADRE']=$animal->madre_codigo;
            $data['FECHA DE NACIMIENTO']=$fechaNacimiento;
            $data['PARTOS MUERTOS']=count($partosNegativos->toArray());
            $data['FINCA']=$finca->nombre;
            $data['LOTE']=$lote->nombre;
            $data['TIPO PRODUCCION']=$produccion;


            $animalCollection->push($data);

    }

        return $animalCollection;




    }

    /**
     * @return array
     */
    public function headings(): array
    {
       return[
           'FECHA REVISION',
           'ANIMAL',
           'SEXO',
           'EDAD',
           'RAZA',
           'PREÑEZ',
           'PARTOS',
           'MADRE',
           'FECHA DE NACIMIENTO',
           'PARTOS MUERTOS',
           'FINCA',
           'LOTE',
           'TIPO PRODUCCION'
       ];
    }


}
