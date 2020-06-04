<?php

namespace Modules\Usuario\Repositories;

use Modules\Usuario\Entities\RolApkRolBoton;
use App\Repositories\BaseRepository;

/**
 * Class RolApkRolBotonRepository
 * @package Modules\Usuario\Repositories
 * @version June 4, 2020, 7:26 pm UTC
*/

class RolApkRolBotonRepository extends BaseRepository
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
        return RolApkRolBoton::class;
    }
}
