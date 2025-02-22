<?php

namespace Modules\CondicionCorporal\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="CondicionCorporal",
 *      required={"code", "descripcion", "active", "negocio_id"},
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
class CondicionCorporal extends Model
{

    public $table = 'condiciones_corporales';
    



    public $fillable = [
        'code',
        'nombre',
        'descripcion',
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
        'active' => 'required',
        'negocio_id' => 'required'
    ];

    public static $tableName = 'condiciones_corporales';
    
}
