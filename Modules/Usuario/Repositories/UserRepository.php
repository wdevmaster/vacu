<?php

namespace Modules\Usuario\Repositories;

use Modules\Usuario\Entities\User;
use App\Repositories\BaseRepository;

/**
 * Class UserRepository
 * @package Modules\Usuario\Repositories
 * @version May 1, 2020, 12:57 pm UTC
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'negocioId',
        'fincaId'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
