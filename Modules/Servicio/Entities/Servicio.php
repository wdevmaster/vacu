<?php

namespace Modules\Servicio\Entities;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Servicio",
 *      required={"code", "fecha", "animal_inceminado", "animal_inseminador", "semen_id", "personal_inseminador", "active", "tipo_servicio_id"},
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
 *          property="animal_inceminado",
 *          description="animal_inceminado",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="animal_inseminador",
 *          description="animal_inseminador",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="semen_id",
 *          description="semen_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="personal_inseminador",
 *          description="personal_inseminador",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="tipo_servicio_id",
 *          description="tipo_servicio_id",
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
class Servicio extends Model
{

    public $table = 'servicios';
    



    public $fillable = [
        'code',
        'fecha',
        'animal_inceminado',
        'animal_inseminador',
        'semen_id',
        'personal_inseminador',
        'active',
        'tipo_servicio_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'animal_inceminado' => 'integer',
        'animal_inseminador' => 'integer',
        'semen_id' => 'integer',
        'personal_inseminador' => 'string',
        'active' => 'boolean',
        'tipo_servicio_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'fecha' => 'required',
        'animal_inceminado' => 'required',
        'animal_inseminador' => 'required',
        'semen_id' => 'required',
        'personal_inseminador' => 'required',
        'active' => 'required',
        'tipo_servicio_id' => 'required'
    ];

    
}
