<?php

namespace Modules\Servicio\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Servicio",
 *      required={"code", "fecha", "animal_inceminado", "animal_inseminador", "semen_id", "personal_inseminador", "active", "tipo_servicio_id","negocio_id"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *           type="integer",
 *          format="int32"
 *      ),
 *     @SWG\Property(
 *          property="fecha",
 *          description="fecha",
 *          type="string",
 *          format="date-time"
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
 *          property="negocio_id",
 *          description="negocio_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="tipo_servicio_id",
 *          description="tipo_servicio_id",
 *          type="integer",
 *          format="int32"
 *      )
 *
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
        'tipo_servicio_id',
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
        'fecha' => 'datetime',
        'animal_inceminado' => 'integer',
        'animal_inseminador' => 'integer',
        'semen_id' => 'integer',
        'personal_inseminador' => 'string',
        'active' => 'boolean',
        'tipo_servicio_id' => 'integer',
        'negocio_id' => 'integer'
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
        'personal_inseminador' => 'required',
        'active' => 'required',
        'tipo_servicio_id' => 'required',
        'negocio_id' => 'required'
    ];

    public static $tableName = 'servicios';
}
