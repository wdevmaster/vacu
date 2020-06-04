<?php

namespace Modules\Usuario\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="UserApk",
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
class UserApk extends Model
{

    public $table = 'user_apks';
    



    public $fillable = [
        'user_id'=> 'integer'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id'=> 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id'=> 'required'
    ];

    public function user(){
        $this->belongsTo(User::class);
    }
}
