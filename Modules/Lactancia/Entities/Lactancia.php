<?php

namespace Modules\Lactancia\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Lactancia",
 *      required={"code", "fecha", "leche", "concentrado", "peso", "animal_id"},
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
 *          property="leche",
 *          description="leche",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="concentrado",
 *          description="concentrado",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="peso",
 *          description="peso",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="animal_id",
 *          description="animal_id",
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
class Lactancia extends Model
{

    public $table = 'lactancias';
    



    public $fillable = [
        'code',
        'fecha',
        'leche',
        'concentrado',
        'peso',
        'animal_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'leche' => 'string',
        'concentrado' => 'string',
        'peso' => 'string',
        'animal_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'fecha' => 'required',
        'leche' => 'required',
        'concentrado' => 'required',
        'peso' => 'required',
        'animal_id' => 'required'
    ];

    
}
