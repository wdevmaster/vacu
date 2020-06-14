<?php

namespace Modules\Muerte\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Muerte",
 *      required={"code", "fecha", "motivo_id", "animal_id"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="integer",
 *          format="int32"
 *      ),
 *     @SWG\Property(
 *          property="fecha",
 *          description="fecha",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="motivo_id",
 *          description="motivo_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="animal_id",
 *          description="animal_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Muerte extends Model
{

    public $table = 'muertes';
    



    public $fillable = [
        'code',
        'fecha',
        'motivo_id',
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
        'fecha' => 'datetime',
        'motivo_id' => 'integer',
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
        'motivo_id' => 'required',
        'animal_id' => 'required'
    ];

    public static $tableName = 'muertes';
    
}
