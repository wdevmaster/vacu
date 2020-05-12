<?php

namespace Modules\Animal\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Animal",
 *      required={"code", "fecha_nacimiento", "sexo", "lote_nacimiento_id", "madre_codigo", "padre_codigo", "raza_codigo", "lote_actual_id", "locomocion_code", "active"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="fecha_nacimiento",
 *          description="fecha_nacimiento",
 *          type="string",
 *          format="date-time",
 *          example="2020-05-12 14:37:39"
 *      ),
 *      @SWG\Property(
 *          property="sexo",
 *          description="sexo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="lote_nacimiento_id",
 *          description="lote_nacimiento_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="madre_codigo",
 *          description="madre_codigo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="padre_codigo",
 *          description="padre_codigo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="raza_codigo",
 *          description="raza_codigo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="lote_actual_id",
 *          description="lote_actual_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="locomocion_code",
 *          description="locomocion_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="inventario_id",
 *          description="inventario_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="temporal_id",
 *          description="temporal_id",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      )
 * )
 */
class Animal extends Model
{

    public $table = 'animales';
    



    public $fillable = [
        'code',
        'fecha_nacimiento',
        'sexo',
        'lote_nacimiento_id',
        'madre_codigo',
        'padre_codigo',
        'raza_codigo',
        'lote_actual_id',
        'locomocion_code',
        'inventario_id',
        'temporal_id',
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
        'fecha_nacimiento' => 'datetime',
        'sexo' => 'string',
        'lote_nacimiento_id' => 'integer',
        'madre_codigo' => 'string',
        'padre_codigo' => 'string',
        'raza_codigo' => 'string',
        'lote_actual_id' => 'integer',
        'locomocion_code' => 'string',
        'inventario_id' => 'integer',
        'temporal_id' => 'integer',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'fecha_nacimiento' => 'required',
        'sexo' => 'required',
        'lote_nacimiento_id' => 'required',
        'madre_codigo' => 'required',
        'padre_codigo' => 'required',
        'raza_codigo' => 'required',
        'lote_actual_id' => 'required',
        'locomocion_code' => 'required',
        'inventario_id' => 'required',
        'temporal_id' => 'required',
        'active' => 'required'
    ];

    
}
