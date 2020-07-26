<?php

namespace Modules\Muerte\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="MotivoMuerte",
 *      required={"nombre", "descripcion"},
 *
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
 *      )
 * )
 */
class MotivoMuerte extends Model
{

    public $table = 'motivo_muertes';
    



    public $fillable = [
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
        'nombre' => 'required'
    ];

    public static $tableName = 'motivo_muertes';
}
