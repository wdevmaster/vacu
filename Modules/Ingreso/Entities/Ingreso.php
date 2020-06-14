<?php

namespace Modules\Ingreso\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Ingreso",
 *      required={"code","fecha", "active", "animal_id", "lote_id"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="integer",
 *          format="int32"
 *      ),
 *       @SWG\Property(
 *          property="fecha",
 *          description="fecha",
 *          type="string",
 *          format="date-time"
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
        'code' => 'integer',
        'fecha' => 'datetime',
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
        'code' => 'required',
        'fecha' => 'required',
        'active' => 'required',
        'animal_id' => 'required',
        'lote_id' => 'required'
    ];

    public static $tableName = 'ingresos';

    
}
