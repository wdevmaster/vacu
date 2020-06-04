<?php

namespace Modules\Usuario\Repositories;

use Modules\Usuario\Entities\UserApk;
use App\Repositories\BaseRepository;

/**
 * Class UserApkRepository
 * @package Modules\Usuario\Repositories
 * @version June 4, 2020, 6:16 am UTC
*/

class UserApkRepository extends BaseRepository
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
        return UserApk::class;
    }
}
