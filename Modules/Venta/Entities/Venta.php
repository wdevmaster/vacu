<?php

namespace Modules\Venta\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Venta",
 *      required={"code", "fecha", "motivo_venta_id", "active", "animal_id", "cliente_id","negocio_id"},
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
 *          property="motivo_venta_id",
 *          description="motivo_venta_id",
 *          type="int32"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="animal_id",
 *          description="animal_id",
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
 *          property="cliente_id",
 *          description="cliente_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Venta extends Model
{

    public $table = 'ventas';
    



    public $fillable = [
        'code',
        'fecha',
        'motivo_venta_id',
        'active',
        'animal_id',
        'cliente_id',
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
        'motivo_venta_id' => 'string',
        'active' => 'boolean',
        'animal_id' => 'integer',
        'cliente_id' => 'integer',
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
        'motivo_venta_id' => 'required',
        'animal_id' => 'required',
        'cliente_id' => 'required',
        'negocio_id' => 'required'
    ];

    public static $tableName = 'ventas';

    
}
