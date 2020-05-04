<?php

namespace Modules\Inseminador\Repositories;

use Modules\Inseminador\Entities\Inseminador;
use App\Repositories\BaseRepository;

/**
 * Class InseminadorRepository
 * @package Modules\Inseminador\Repositories
 * @version May 4, 2020, 1:00 pm UTC
*/

class InseminadorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'codigo',
        'nombre',
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
        return Inseminador::class;
    }
}
