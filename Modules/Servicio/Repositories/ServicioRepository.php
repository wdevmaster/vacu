<?php

namespace Modules\Servicio\Repositories;

use Modules\Servicio\Entities\Servicio;
use App\Repositories\BaseRepository;

/**
 * Class ServicioRepository
 * @package Modules\Servicio\Repositories
 * @version May 4, 2020, 2:05 pm UTC
*/

class ServicioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'fecha',
        'animal_inceminado',
        'animal_inseminador',
        'semen_id',
        'personal_inseminador',
        'active',
        'tipo_servicio_id'
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
        return Servicio::class;
    }
}
