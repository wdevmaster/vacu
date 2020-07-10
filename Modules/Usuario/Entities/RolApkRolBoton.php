<?php

namespace Modules\Usuario\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="RolApkRolBoton",
 *      required={""}
 * )
 */
class RolApkRolBoton extends Model
{

    public $table = 'rol_apk_rol_botons';
    



    public $fillable = [
        'rol_apk_id',
        'rol_boton_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'rol_apk_id' => 'integer',
        'rol_boton_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'rol_apk_id' => 'required',
        'rol_boton_id' => 'required'
    ];

    public function rol_apk()
    {
        return $this->belongsTo(RolApk::class);
    }

    public function rol_boton()
    {
       return $this->belongsTo(RolBoton::class);
    }
}
