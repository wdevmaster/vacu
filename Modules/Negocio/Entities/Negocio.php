<?php

namespace Modules\Negocio\Entities;

use App\Models\Eloquent as Model;
use Modules\Usuario\Entities\ClienteNegocio;

/**
 * @SWG\Definition(
 *      definition="Negocio",
 *      required={"code", "nombre", "jefe", "telefono", "active"},
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
 *          property="jefe",
 *          description="jefe",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="telefono",
 *          description="telefono",
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
class Negocio extends Model
{

    public $table = 'negocios';


    public $fillable = [
        'code',
        'nombre',
        'jefe',
        'telefono',
        'active'
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
        'jefe' => 'string',
        'telefono' => 'integer',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'nombre' => 'required',
        'jefe' => 'required',
        'telefono' => 'required',
        'active' => 'required'
    ];

    public static $tableName = 'negocios';


    public function clientes_negocios()
    {
        $this->hasMany(ClienteNegocio::class);
    }


}
