<?php

namespace Modules\Configuracion\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Configuracion",
 *      required={"configuracion_id", "clave", "description", "valor"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="configuracion_id",
 *          description="configuracion_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="clave",
 *          description="clave",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="valor",
 *          description="valor",
 *          type="string"
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
class Configuracion extends Model
{

    public $table = 'configuracions';
    



    public $fillable = [
        'configuracion_id',
        'clave',
        'description',
        'valor'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'configuracion_id' => 'string',
        'clave' => 'string',
        'description' => 'string',
        'valor' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'configuracion_id' => 'required',
        'clave' => 'required',
        'description' => 'required',
        'valor' => 'required'
    ];

    
}
