<?php

namespace Modules\Configuracion\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Configuracion",
 *      required={ "clave", "descripcion", "valor"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="clave",
 *          description="clave",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="descripcion",
 *          description="descripcion",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="valor",
 *          description="valor",
 *          type="string"
 *      )
 * )
 */
class Configuracion extends Model
{

    public $table = 'configuraciones';
    



    public $fillable = [
        'clave',
        'descripcion',
        'valor'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'clave' => 'string',
        'descripcion' => 'string',
        'valor' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'clave' => 'required',
        'descripcion' => 'required',
        'valor' => 'required'
    ];

    
}
