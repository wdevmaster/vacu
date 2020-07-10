<?php

namespace Modules\Usuario\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="UserApk",
 *      required={""}
 *
 * )
 */
class UserApk extends Model
{

    public $table = 'user_apks';
    



    public $fillable = [
        'user_id',
        'rol_apk_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id'=> 'integer',
         'rol_apk_id'=> 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    public function user(){
        $this->belongsTo(User::class);
    }

    public function rol_apk(){
        return $this->hasOne(RolApk::class);
    }
}
