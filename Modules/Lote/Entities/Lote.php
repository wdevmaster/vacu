<?php

namespace Modules\Lote\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Lote",
 *      required={"code", "numero", "nombre", "active", "finca_id","negocio_id"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="numero",
 *          description="numero",
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
 *      ),
 *      @SWG\Property(
 *          property="finca_id",
 *          description="finca_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Lote extends Model
{

    public $table = 'lotes';
    



    public $fillable = [
        'code',
        'numero',
        'nombre',
        'active',
        'finca_id',
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
        'numero' => 'integer',
        'nombre' => 'string',
        'active' => 'boolean',
        'finca_id' => 'integer',
        'negocio_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'numero' => 'required',
        'nombre' => 'required',
        'active' => 'required',
        'finca_id' => 'required',
        'negocio_id' => 'required'
    ];

    public static $tableName = 'lotes';
}
