<?php

namespace Modules\Configuracion\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Configuracion",
 *      required={ "code","clave", "descripcion", "valor","active","negocio_id"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="integer",
 *          format="int32"
 *      ),
 *     @SWG\Property(
 *          property="clave",
 *          description="clave",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="descripcion",
 *          description="descripcion",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="valor",
 *          description="valor",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="negocio_id",
 *          description="negocio_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="Active",
 *          type="boolean"
 *      )
 * )
 */
class Configuracion extends Model
{

    public $table = 'configuraciones';
    



    public $fillable = [
        'code',
        'clave',
        'descripcion',
        'valor',
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
        'clave' => 'integer',
        'descripcion' => 'string',
        'valor' => 'string',
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
        'clave' => 'required',
        'descripcion' => 'required',
        'valor' => 'required',
        'active' => 'required',
        'negocio_id' => 'required',

    ];

    public static $tableName = 'configuraciones';

}
