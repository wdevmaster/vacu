<?php

namespace Modules\Usuario\Repositories;

use App\Repositories\BaseRepository;
use Modules\Usuario\Entities\RolHasRolBoton;

/**
 * Class RolHasRolBotonRepository
 * @package Modules\Usuario\Repositories
 * @version June 4, 2020, 7:26 pm UTC
*/

class RolHasRolBotonRepository extends BaseRepository
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
        return RolHasRolBoton::class;
    }

}
