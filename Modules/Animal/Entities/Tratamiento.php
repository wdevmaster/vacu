<?php

namespace Modules\Animal\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Tratamiento",
 *      required={"code", "animal_code", "fecha", "negocio_id", "nota"},
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="animal_code",
 *          description="animal_code",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="fecha",
 *          description="fecha",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="negocio_id",
 *          description="negocio_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *
 *      @SWG\Property(
 *          property="nota",
 *          description="nota",
 *          type="string"
 *  ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      )
 * )
 */
class Tratamiento extends Model
{

    public $table = 'tratamientos';
    



    public $fillable = [
        'code',
        'animal_code',
        'fecha',
        'negocio_id',
        'nota',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'integer',
        'animal_code' => 'integer',
        'fecha' => 'datetime',
        'negocio_id' => 'integer',
        'nota' => 'string',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'animal_code' => 'required',
        'fecha' => 'required',
        'negocio_id' => 'required',
        'nota' => 'required'
    ];

    public static $tableName = 'tratamientos';

    
}
