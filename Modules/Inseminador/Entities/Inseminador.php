<?php

namespace Modules\Inseminador\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Inseminador",
 *      required={"codigo", "nombre", "active", "negocio_id"},
 *
 *      @SWG\Property(
 *          property="codigo",
 *          description="codigo",
 *          type="integer",
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
 *      ),
 *      @SWG\Property(
 *          property="negocio_id",
 *          description="negocio_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Inseminador extends Model
{

    public $table = 'inseminadores';
    



    public $fillable = [
        'codigo',
        'nombre',
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
        'codigo' => 'integer',
        'nombre' => 'string',
        'active' => 'boolean',
        'negocio_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'required',
        'nombre' => 'required',
        'active' => 'required',
        'negocio_id' => 'required'
    ];

    public static $tableName = 'inseminadores';

    
}
