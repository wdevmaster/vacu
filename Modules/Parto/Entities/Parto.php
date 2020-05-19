<?php

namespace Modules\Parto\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Parto",
 *      required={"code", "fecha", "sexo", "animal_nacido", "madre_code", "active", "raza_id"},
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
 *          property="sexo",
 *          description="sexo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="animal_nacido",
 *          description="animal_nacido",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="madre_code",
 *          description="madre_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="raza_id",
 *          description="raza_id",
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
class Parto extends Model
{

    public $table = 'partos';
    



    public $fillable = [
        'code',
        'fecha',
        'sexo',
        'animal_nacido',
        'madre_code',
        'active',
        'raza_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'sexo' => 'string',
        'animal_nacido' => 'string',
        'madre_code' => 'string',
        'active' => 'boolean',
        'raza_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'fecha' => 'required',
        'sexo' => 'required',
        'animal_nacido' => 'required',
        'madre_code' => 'required',
        'active' => 'required',
        'raza_id' => 'required'
    ];

    public static $tableName = 'partos';

    
}
