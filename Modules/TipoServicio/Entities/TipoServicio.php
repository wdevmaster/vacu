<?php

namespace Modules\TipoServicio\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="TipoServicio",
 *      required={"code", "nombre", "descripcion"},
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
 *      )
 *
 * )
 */
class TipoServicio extends Model
{

    public $table = 'tipos_servicios';
    



    public $fillable = [
        'code',
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
        'code' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'nombre' => 'required',
        'descripcion' => 'required'
    ];

    public static $tableName = 'tipos_servicios';

    
}
