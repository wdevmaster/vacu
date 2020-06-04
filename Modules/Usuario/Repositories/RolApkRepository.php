<?php

namespace Modules\Usuario\Repositories;

use Modules\Usuario\Entities\RolApk;
use App\Repositories\BaseRepository;

/**
 * Class RolApkRepository
 * @package Modules\Usuario\Repositories
 * @version June 4, 2020, 6:08 am UTC
*/

class RolApkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion'
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
        return RolApk::class;
    }
}
