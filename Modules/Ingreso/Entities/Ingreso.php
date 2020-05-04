<?php

namespace Modules\Ingreso\Entities;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Ingreso",
 *      required={"code","fecha", "active", "animal_id", "lote_id"},
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
 *          property="lote_id",
 *          description="lote_id",
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
class Ingreso extends Model
{

    public $table = 'ingresos';
    



    public $fillable = [
        'code',
        'fecha',
        'active',
        'animal_id',
        'lote_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'active' => 'boolean',
        'animal_id' => 'integer',
        'lote_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'fecha datatime',
        'fecha' => 'required',
        'active' => 'required',
        'animal_id' => 'required',
        'lote_id' => 'required'
    ];

    
}
