<?php

namespace Modules\Finca\Entities;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Finca",
 *      required={"finca_id",  "motivo", "nombre", "numero", "negocio_id", "active"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="finca_id",
 *          description="finca_id",
 *          type="integer",
 *          format="int32"
 *      ),
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
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Finca extends Model
{

    public $table = 'fincas';
    



    public $fillable = [
        'finca_id',
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
        'finca_id' => 'integer',
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
        'finca_id' => 'required',
        'nombre' => 'required',
        'numero' => 'required',
        'negocio_id' => 'required',
        'active' => 'required'
    ];

    
}
