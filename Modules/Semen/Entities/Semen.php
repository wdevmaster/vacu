<?php

namespace Modules\Semen\Entities;

use App\Models\Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Semen",
 *      required={"code", "active", "id_animal"},
 *
 *      @SWG\Property(
 *          property="code",
 *          description="code",
 *           type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="id_animal",
 *          description="id_animal",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Semen extends Model
{

    public $table = 'semens';
    



    public $fillable = [
        'code',
        'active',
        'id_animal'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'integer',
        'active' => 'boolean',
        'id_animal' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required',
        'active' => 'required',
        'id_animal' => 'required'
    ];

    public static $tableName = 'semens';

    
}
