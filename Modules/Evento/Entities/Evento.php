<?php

namespace Modules\Evento\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Evento",
 *      required={"animal_id", "tipo_evento"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
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
 *          property="tipo_evento",
 *          description="tipo_evento",
 *          type="string"
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
class Evento extends Model
{

    public $table = 'eventos';
    



    public $fillable = [
        'fecha',
        'animal_id',
        'tipo_evento'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fecha' => 'datetime',
        'animal_id' => 'integer',
        'tipo_evento' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fecha' => 'required',
        'animal_id' => 'required',
        'tipo_evento' => 'required'
    ];

    
}
