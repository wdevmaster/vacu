<?php

namespace Modules\Locomocion\Repositories;

use Modules\Locomocion\Entities\Locomocion;
use App\Repositories\BaseRepository;

/**
 * Class LocomocionRepository
 * @package Modules\Locomocion\Repositories
 * @version May 4, 2020, 1:10 pm UTC
*/

class LocomocionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'nombre',
        'descripcion',
        'active',
        'negocio_id'
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
        return Locomocion::class;
    }
}
