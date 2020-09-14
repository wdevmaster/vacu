<?php

namespace Modules\Semen\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Semen",
 *      required={"code", "active", "id_animal","negocio_id"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *           type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="negocio_id",
 *          description="negocio_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="semen_code",
 *          description="Semen Code",
 *          type="string",
 *          example="0001DPD"
 *      )
 * )
 */
class Semen extends Model
{

    public $table = 'semens';
    



    public $fillable = [
        'code',
        'active',
        'semen_code',
        'negocio_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'integer',
        'active' => 'boolean',
        'semen_code' => 'string',
        'negocio_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'active' => 'required',
        'semen_code' => 'required',
        'negocio_id' => 'required'
    ];

    public static $tableName = 'semens';

    
}
