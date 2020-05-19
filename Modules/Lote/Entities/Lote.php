<?php

namespace Modules\Lote\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Lote",
 *      required={"lote_id", "numero", "nombre", "active", "finca_id"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="lote_id",
 *          description="lote_id",
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
 *          property="finca_id",
 *          description="finca_id",
 *          type="integer",
 *          format="int32"
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
class Lote extends Model
{

    public $table = 'lotes';
    



    public $fillable = [
        'lote_id',
        'numero',
        'nombre',
        'active',
        'finca_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'lote_id' => 'integer',
        'numero' => 'integer',
        'nombre' => 'string',
        'active' => 'boolean',
        'finca_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'lote_id' => 'required',
        'numero' => 'requires',
        'nombre' => 'required',
        'active' => 'required',
        'finca_id' => 'required'
    ];

    public static $tableName = 'lotes';
}
