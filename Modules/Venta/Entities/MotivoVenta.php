<?php

namespace Modules\Venta\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="MotivoVenta",
 *      required={"nombre", "descripcion", "active"},
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
class MotivoVenta extends Model
{

    public $table = 'motivo_ventas';
    



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


    public static $tableName = 'motivo_ventas';
    
}
