<?php

namespace Modules\Evento\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Evento",
 *      required={"code","fecha","animal_id", "tipo_evento","active","negocio_id"},
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
 *          property="animal_id",
 *          description="animal_id",
 *          type="integer",
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
 *          property="tipo_evento",
 *          description="tipo_evento",
 *          type="string"
 *      )
 * )
 */
class Evento extends Model
{

    public $table = 'eventos';
    



    public $fillable = [
        'code',
        'fecha',
        'animal_id',
        'tipo_evento',
        'active',
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
        'animal_id' => 'integer',
        'tipo_evento' => 'string',
        'negocio_id' => 'integer',
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
        'animal_id' => 'required',
        'tipo_evento' => 'required',
        'negocio_id' => 'required',
        'active' => 'required'
    ];

    public static $tableName = 'eventos';

    
}
