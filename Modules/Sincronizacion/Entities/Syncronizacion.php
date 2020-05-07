<?php

namespace Modules\Sincronizacion\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Syncronizacion",
 *      required={"table", "accion", "data", "user_id"},
 *
 *      @SWG\Property(
 *          property="tabla",
 *          description="tabla",
 *          type="string",
 *          example="animales"
 *      ),
 *      @SWG\Property(
 *          property="accion",
 *          description="accion",
 *          type="string",
 *          example="INSERT,UPDATE,DELETE"
 *      ),
 *      @SWG\Property(
 *          property="data",
 *          description="data exactamente igual a la que se tiene que insertar en cualquier tabla en formato json",
 *          type="string",
 *          format="json",
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 * )
 */
class Syncronizacion extends Model
{

    public $table = 'sincronizaciones';
    



    public $fillable = [
        'tabla',
        'accion',
        'data',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tabla' => 'string',
        'accion' => 'string',
        'data' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tabla' => 'required',
        'accion' => 'required',
        'data' => 'required',
        'user_id' => 'required'
    ];

    
}
