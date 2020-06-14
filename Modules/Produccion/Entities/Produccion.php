<?php

namespace Modules\Produccion\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Produccion",
 *      required={"code", "fecha", "peso", "active", "animal_id"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *           type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="peso",
 *          description="peso",
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
 *      )
 * )
 */
class Produccion extends Model
{

    public $table = 'producciones';
    



    public $fillable = [
        'code',
        'fecha',
        'peso',
        'active',
        'animal_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'integer',
        'peso' => 'string',
        'active' => 'boolean',
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
        'peso' => 'required',
        'active' => 'required',
        'animal_id' => 'required'
    ];

    public static $tableName = 'producciones';

    
}
