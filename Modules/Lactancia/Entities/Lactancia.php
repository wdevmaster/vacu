<?php

namespace Modules\Lactancia\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Lactancia",
 *      required={"code", "fecha", "leche", "concentrado", "peso", "animal_id","active"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="integer",
 *           format="int32"
 *      ),
 *     @SWG\Property(
 *          property="fecha",
 *          description="fecha",
 *          type="string",
 *          example="2020-06-30 17:41:29"
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
 *     @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="animal_id",
 *          description="animal_id",
 *          type="integer",
 *          format="int32"
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
        'animal_id',
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
        'fecha'=> 'datetime',
        'leche' => 'string',
        'concentrado' => 'string',
        'peso' => 'string',
        'animal_id' => 'integer',
        'active' => 'boolean'
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
        'animal_id' => 'required',
        'active' => 'required'
    ];

    public static $tableName = 'lactancias';

    
}
