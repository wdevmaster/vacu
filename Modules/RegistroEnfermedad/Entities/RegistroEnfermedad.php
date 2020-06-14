<?php

namespace Modules\RegistroEnfermedad\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="RegistroEnfermedad",
 *      required={"code", "fecha_enfermedad", "fecha", "active", "id_animal", "id_enfermedad"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *         type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="id_animal",
 *          description="id_animal",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="id_enfermedad",
 *          description="id_enfermedad",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class RegistroEnfermedad extends Model
{

    public $table = 'registros_enfermedades';
    



    public $fillable = [
        'code',
        'fecha_enfermedad',
        'fecha',
        'active',
        'id_animal',
        'id_enfermedad'
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
        'id_animal' => 'integer',
        'id_enfermedad' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'fecha_enfermedad' => 'required',
        'fecha' => 'required',
        'active' => 'required',
        'id_animal' => 'required',
        'id_enfermedad' => 'required'
    ];
    public static $tableName = 'registros_enfermedades';

    
}
