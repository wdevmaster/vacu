<?php

namespace Modules\Usuario\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="RolApkRolBoton",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
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
        $this->belongsTo(RolApk::class);
    }

    public function rol_boton()
    {
        $this->belongsTo(RolBoton::class);
    }
}
