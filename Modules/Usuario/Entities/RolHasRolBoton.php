<?php

namespace Modules\Usuario\Entities;

use App\Models\Eloquent as Model;
use App\Models\Role;

/**
 * @SWG\Definition(
 *      definition="RolHasRolBoton",
 *      required={""}
 * )
 */
class RolHasRolBoton extends Model
{

    public $table = 'rol_has_rol_botons';
    



    public $fillable = [
        'rol_id',
        'rol_boton_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'bigInteger',
        'rol_id' => 'integer',
        'rol_boton_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'rol_id' => 'required',
        'rol_boton_id' => 'required'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function rol_boton()
    {
       return $this->belongsTo(RolBoton::class);
    }
}
