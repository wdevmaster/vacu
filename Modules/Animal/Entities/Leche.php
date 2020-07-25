<?php

namespace Modules\Animal\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Leche",
 *      required={"code", "animal_code", "peso", "fecha", "negocio_id"},
 *     @SWG\Property(
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
 *          property="peso",
 *          description="peso",
 *          type="number",
 *          format="number"
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
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      )
 * )
 */
class Leche extends Model
{

    public $table = 'leches';
    



    public $fillable = [
        'code',
        'animal_code',
        'peso',
        'fecha',
        'negocio_id',
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
        'peso' => 'float',
        'fecha' => 'datetime',
        'negocio_id' => 'integer',
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
        'peso' => 'required',
        'fecha' => 'required',
        'negocio_id' => 'required'
    ];

    public static $tableName = 'leches';

    
}
