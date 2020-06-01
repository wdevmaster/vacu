<?php

namespace Modules\Usuario\Repositories;

use Modules\Usuario\Entities\RolBoton;
use App\Repositories\BaseRepository;

/**
 * Class RolBotonRepository
 * @package Modules\Usuario\Repositories
 * @version May 31, 2020, 7:24 pm UTC
*/

class RolBotonRepository extends BaseRepository
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
        return RolBoton::class;
    }
}
