<?php

namespace Modules\TipoServicio\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="TipoServicio",
 *      required={"tipo_servicio_id", "nombre", "descripcion"},
 *
 *      @SWG\Property(
 *          property="tipo_servicio_id",
 *          description="tipo_servicio_id",
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
 *      )
 *
 * )
 */
class TipoServicio extends Model
{

    public $table = 'tipos_servicios';
    



    public $fillable = [
        'tipo_servicio_id',
        'nombre',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipo_servicio_id' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipo_servicio_id' => 'required',
        'nombre' => 'required',
        'descripcion' => 'required'
    ];

    public static $tableName = 'tipos_servicios';

    
}
