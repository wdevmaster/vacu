<?php

namespace Modules\Usuario\Repositories;

use Modules\Usuario\Entities\UserApi;
use App\Repositories\BaseRepository;

/**
 * Class UserApiRepository
 * @package Modules\Usuario\Repositories
 * @version June 4, 2020, 6:13 am UTC
*/

class UserApiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
        return UserApi::class;
    }
}
