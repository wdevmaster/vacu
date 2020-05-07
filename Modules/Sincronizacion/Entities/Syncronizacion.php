<?php

namespace Modules\Sincronizacion\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Syncronizacion",
 *      required={"table", "accion", "data", "user_id"},
 *
 *      @SWG\Property(
 *          property="table",
 *          description="table",
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
 *          description="data",
 *          type="array",
 *          @SWG\Items(
 *              @SWG\Property(
                    property="key",
 *                  description="Nombre del campo que se va a modificar o insertar",
 *                  example="id"
 *              ),
 *             @SWG\Property(
 *                  property="value",
 *                  description="Valor del campo asociado",
 *                  example=1
 *              ),
 *
 *          )
 *
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
