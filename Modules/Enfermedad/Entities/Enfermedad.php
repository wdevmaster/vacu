<?php

namespace Modules\Enfermedad\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Enfermedad",
 *      required={"code", "nombre", "descripcion", "active"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="nombre",
 *          description="nombre",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="descripcion",
 *          description="descripcion",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      ) *
 * )
 */
class Enfermedad extends Model
{

    public $table = 'enfermedades';
    



    public $fillable = [
        'code',
        'nombre',
        'descripcion',
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
        'nombre' => 'string',
        'descripcion' => 'string',
        'active' => 'boolean'

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'nombre' => 'required',
        'descripcion' => 'required',
        'active' => 'required'

    ];

    public static $tableName = 'enfermedades';
    
}
