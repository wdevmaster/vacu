<?php

namespace Modules\EstadoFisico\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="EstadoFisico",
 *      required={"code", "fecha", "animal_id", "active", "condicion_id", "locomocion_id","negocio_id"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
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
 *          property="animal_id",
 *          description="animal_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="condicion_id",
 *          description="condicion_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="negocio_id",
 *          description="negocio_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="locomocion_id",
 *          description="locomocion_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class EstadoFisico extends Model
{

    public $table = 'estados_fisicos';
    



    public $fillable = [
        'code',
        'fecha',
        'animal_id',
        'active',
        'condicion_id',
        'locomocion_id',
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
        'animal_id' => 'integer',
        'active' => 'boolean',
        'condicion_id' => 'integer',
        'locomocion_id' => 'integer',
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
        'animal_id' => 'required',
        'active' => 'required',
        'condicion_id' => 'required',
        'locomocion_id' => 'required',
        'negocio_id' => 'required'
    ];

    public static $tableName = 'estados_fisicos';

    
}
