<?php

namespace Modules\Parto\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Parto",
 *      required={"code", "fecha", "sexo", "animal_nacido", "madre_code", "active","positivo", "raza_id","negocio_id"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="integer",
 *          format="int32"
 *      ),
 *     @SWG\Property(
 *          property="fecha",
 *          description="fecha",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="sexo",
 *          description="sexo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="animal_nacido",
 *          description="animal_nacido",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="madre_code",
 *          description="madre_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="positivo",
 *          description="positivo",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="negocio_id",
 *          description="negocio_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="raza_id",
 *          description="raza_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Parto extends Model
{

    public $table = 'partos';
    



    public $fillable = [
        'code',
        'fecha',
        'sexo',
        'animal_nacido',
        'madre_code',
        'active',
        'positivo',
        'raza_id',
        'negocio_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'integer',
        'fecha' => 'datetime',
        'sexo' => 'string',
        'animal_nacido' => 'string',
        'madre_code' => 'string',
        'active' => 'boolean',
        'positivo' => 'boolean',
        'raza_id' => 'integer',
        'negocio_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'fecha' => 'required',
        'sexo' => 'required',
        'animal_nacido' => 'required',
        'madre_code' => 'required',
        'active' => 'required',
        'raza_id' => 'required',
        'negocio_id' => 'required'
    ];

    public static $tableName = 'partos';



    public static function generarCodigo(){
        $mayor = -1;
        $partos = Parto::all();
        if ($partos->count() > 0){
            foreach ($partos as $parto){
                if ($parto->code > $mayor){
                    $mayor = $parto->code;
                }
            }
            return $mayor + 1;
        }
        return 1;


    }

    
}
