<?php

namespace Modules\Configuracion\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Configuracion",
 *      required={ "code", "descripcion", "valor","active"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="integer"
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
        'descripcion',
        'valor',
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
        'descripcion' => 'string',
        'valor' => 'string',
        'active' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'descripcion' => 'required',
        'valor' => 'required',
        'active' => 'required',

    ];

    public static $tableName = 'configuraciones';

}
