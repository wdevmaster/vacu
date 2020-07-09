<?php

namespace Modules\Bitacora\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Bitacora",
 *      required={"fecha_generacion", "codigo_usuario", "codigo_generado", "entidad", "usuario_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="fecha_generacion",
 *          description="fecha_generacion",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="codigo_usuario",
 *          description="codigo_usuario",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="codigo_generado",
 *          description="codigo_generado",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="entidad",
 *          description="entidad",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="usuario_id",
 *          description="usuario_id",
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
class Bitacora extends Model
{

    public $table = 'bitacoras';
    



    public $fillable = [
        'fecha_generacion',
        'codigo_usuario',
        'codigo_generado',
        'entidad',
        'usuario_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fecha_generacion' => 'datetime',
        'codigo_usuario' => 'integer',
        'codigo_generado' => 'integer',
        'entidad' => 'string',
        'usuario_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fecha_generacion' => 'required',
        'codigo_usuario' => 'required',
        'codigo_generado' => 'required',
        'entidad' => 'required',
        'usuario_id' => 'required'
    ];

    
}
