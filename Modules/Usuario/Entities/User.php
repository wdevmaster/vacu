<?php

namespace Modules\Usuario\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

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
 *          property="negocio_id",
 *          description="negocio_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="finca_id",
 *          description="finca_id",
 *          type="integer",
 *          format="int32"
 *      )
 *      )
 * )
 */
class User extends Authenticatable
{

    use HasApiTokens, Notifiable, HasRoles;

    public $table = 'users';
    



    public $fillable = [
        'name',
        'email',
        'password',
        'negocio_id',
        'finca_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at', 'roles', 'remember_token', 'password'];

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
        'negocio_id' => 'integer',
        'finca_id' => 'integer'
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
        'negocio_id' => 'required',
        'finca_id' => 'required'
    ];

}
