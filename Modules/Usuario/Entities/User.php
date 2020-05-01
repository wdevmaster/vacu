<?php

namespace Modules\Usuario\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="User",
 *      required={"name", "password", "negocioId", "fincaId"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="negocioId",
 *          description="negocioId",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="fincaId",
 *          description="fincaId",
 *          type="integer",
 *          format="int32"
 *      )
 *      )
 * )
 */
class User extends Model
{

    public $table = 'users';
    



    public $fillable = [
        'name',
        'email',
        'password',
        'negocioId',
        'fincaId'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'negocioId' => 'integer',
        'fincaId' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'email',
        'password' => 'required',
        'negocioId' => 'required',
        'fincaId' => 'required'
    ];

    
}
