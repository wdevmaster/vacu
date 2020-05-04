<?php

namespace Modules\Venta\Entities;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Venta",
 *      required={"code", "fecha", "motivo", "active", "animal_id", "cliente_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="motivo",
 *          description="motivo",
 *          type="string"
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
 *          property="cliente_id",
 *          description="cliente_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Venta extends Model
{

    public $table = 'ventas';
    



    public $fillable = [
        'code',
        'fecha',
        'motivo',
        'active',
        'animal_id',
        'cliente_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'motivo' => 'string',
        'active' => 'boolean',
        'animal_id' => 'integer',
        'cliente_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'fecha' => 'required',
        'motivo' => 'required',
        'active' => 'required',
        'animal_id' => 'required',
        'cliente_id' => 'required'
    ];

    
}
