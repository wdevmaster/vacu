<?php

namespace Modules\Sincronizacion\Entities;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Syncronizacion",
 *      required={"table", "accion", "data", "user_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="table",
 *          description="table",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="accion",
 *          description="accion",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="data",
 *          description="data",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
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
class Syncronizacion extends Model
{

    public $table = 'syncronizacions';
    



    public $fillable = [
        'table',
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
        'table' => 'string',
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
        'table' => 'required',
        'accion' => 'required',
        'data' => 'required',
        'user_id' => 'required'
    ];

    
}
