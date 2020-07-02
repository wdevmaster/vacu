<?php

namespace Modules\Raza\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Raza",
 *      required={"code", "nombre", "active", "negocio_id"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *         type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="nombre",
 *          description="nombre",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      )
 * )
 */
class Raza extends Model
{

    public $table = 'razas';
    



    public $fillable = [
        'code',
        'nombre',
        'active',
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
        'active' => 'boolean',
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
    ];

    public static $tableName = 'razas';
    
}
