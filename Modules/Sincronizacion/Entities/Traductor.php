<?php

namespace Modules\Sincronizacion\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Traductor",
 *      required={"user_id", "user_code", "generate_code" , "negocio_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_code",
 *          description="user_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="generate_code",
 *          description="generate_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="tabla",
 *          description="tabla",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="negocio_id",
 *          description="negocio_id",
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
class Traductor extends Model
{

    public $table = 'traducciones';
    



    public $fillable = [
        'user_id',
        'user_code',
        'generate_code',
        'tabla',
        'negocio_id'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'user_code' => 'string',
        'generate_code' => 'string',
        'tabla' => 'string',
        'negocio_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'user_code' => 'required',
        'generate_code' => 'required',
        'tabla' => 'requerid',
        'negocio_id' => 'integer'
    ];

    
}
