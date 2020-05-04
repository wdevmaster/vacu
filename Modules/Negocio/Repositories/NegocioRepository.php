<?php

namespace Modules\Negocio\Repositories;

use Modules\Negocio\Entities\Negocio;
use App\Repositories\BaseRepository;

/**
 * Class NegocioRepository
 * @package Modules\Negocio\Repositories
 * @version May 4, 2020, 1:22 pm UTC
*/

class NegocioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'negocio_id',
        'nombre',
        'jefe',
        'telefono',
        'active'
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
        return Negocio::class;
    }
}
