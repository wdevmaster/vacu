<?php

namespace Modules\Animal\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Palpacion",
 *      required={"code", "animal_code", "celo_id","negocio_id", "fecha"},
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
 *          property="celo_id",
 *          description="celo_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="fecha",
 *          description="fecha",
 *          type="string",
 *          format="date-time"
 *      ),
 *     @SWG\Property(
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
class Palpacion extends Model
{

    public $table = 'palpaciones';
    



    public $fillable = [
        'code',
        'animal_code',
        'celo_id',
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
        'celo_id' => 'integer',
        'fecha' => 'datetime',
        'negocio_id'=> 'integer',
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
        'negocio_id'=> 'required',
        'fecha' => 'required'
    ];

    public static $tableName = 'palpaciones';

    
}
