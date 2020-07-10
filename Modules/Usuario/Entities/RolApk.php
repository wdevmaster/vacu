<?php

namespace Modules\Usuario\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="RolApk",
 *      required={"nombre", "descripcion"},
 *
 *      @SWG\Property(
 *          property="nombre",
 *          description="nombre",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="descripcion",
 *          description="descripcion",
 *          type="string"
 *      )
 *
 * )
 */
class RolApk extends Model
{

    public $table = 'rol_apks';
    



    public $fillable = [
        'nombre',
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'descripcion' => 'required'
    ];

    public function rol_apk_rol_boton(){
        return $this->hasMany(RolApkRolBoton::class);
    }

    public function user_apk(){
        return $this->hasMany(UserApk::class);
    }

    public static $tableName = 'rol_apks';
}
