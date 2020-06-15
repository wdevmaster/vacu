<?php

namespace Modules\Usuario\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="UserApi",
 *      required={""}
 *
 * )
 */
class UserApi extends Model
{

    public $table = 'user_apis';
    



    public $fillable = [
        'user_id'
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
