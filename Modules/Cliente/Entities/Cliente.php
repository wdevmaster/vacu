<?php

namespace Modules\Cliente\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Cliente",
 *      required={"code", "nombre", "descripcion", "telefono", "active", "negocio_id"},
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
 *      ),
 *      @SWG\Property(
 *          property="telefono",
 *          description="telefono",
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
 *      )
 * )
 */
class Cliente extends Model
{

    public $table = 'clientes';
    



    public $fillable = [
        'code',
        'nombre',
        'descripcion',
        'telefono',
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
        'nombre' => 'string',
        'descripcion' => 'string',
        'telefono' => 'string',
        'active' => 'boolean',
        'negocio_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'nombre' => 'required',
        'descripcion' => 'required',
        'telefono' => 'required',
        'active' => 'required',
        'negocio_id' => 'required'
    ];

    
}
