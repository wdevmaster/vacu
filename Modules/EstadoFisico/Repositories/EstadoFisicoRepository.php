<?php

namespace Modules\EstadoFisico\Repositories;

use Modules\EstadoFisico\Entities\EstadoFisico;
use App\Repositories\BaseRepository;

/**
 * Class EstadoFisicoRepository
 * @package Modules\EstadoFisico\Repositories
 * @version May 4, 2020, 12:35 pm UTC
*/

class EstadoFisicoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'fecha',
        'animal_id',
        'active',
        'condicion_id',
        'locomocion_id'
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
        return EstadoFisico::class;
    }
}
