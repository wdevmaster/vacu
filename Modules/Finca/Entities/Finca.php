<?php

namespace Modules\Finca\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Finca",
 *      required={"motivo", "nombre", "numero", "negocio_id", "active"},
 *
 *      @SWG\Property(
 *          property="nombre",
 *          description="nombre",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="numero",
 *          description="numero",
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
 *          description="active",
 *          type="boolean"
 *      )
 * )
 */
class Finca extends Model
{

    public $table = 'fincas';
    



    public $fillable = [
        'nombre',
        'numero',
        'negocio_id',
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
        'numero' => 'integer',
        'negocio_id' => 'integer',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'numero' => 'required',
        'negocio_id' => 'required',
        'active' => 'required'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public static $tableName = 'fincas';

    
}
