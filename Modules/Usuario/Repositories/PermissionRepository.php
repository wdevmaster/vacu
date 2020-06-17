<?php

namespace Modules\Usuario\Repositories;

use App\Models\Permission;
use App\Repositories\BaseRepository;

/**
 * Class PermissionRepository
 * @package Modules\Usuario\Repositories
 * @version June 1, 2020, 3:36 am UTC
 */
class PermissionRepository extends BaseRepository
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
        return Permission::class;
    }

    public function create($input)
    {
        $permission = Permission::create($input);
        return $permission;
    }
}
