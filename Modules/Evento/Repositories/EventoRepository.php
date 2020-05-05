<?php

namespace Modules\Evento\Repositories;

use Modules\Evento\Entities\Evento;
use App\Repositories\BaseRepository;

/**
 * Class EventoRepository
 * @package Modules\Evento\Repositories
 * @version May 5, 2020, 3:46 am UTC
*/

class EventoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha',
        'animal_id',
        'tipo_evento'
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
        return Evento::class;
    }
}
