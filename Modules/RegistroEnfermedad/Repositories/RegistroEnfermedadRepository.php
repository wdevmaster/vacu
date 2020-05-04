<?php

namespace Modules\RegistroEnfermedad\Repositories;

use Modules\RegistroEnfermedad\Entities\RegistroEnfermedad;
use App\Repositories\BaseRepository;

/**
 * Class RegistroEnfermedadRepository
 * @package Modules\RegistroEnfermedad\Repositories
 * @version May 4, 2020, 1:55 pm UTC
*/

class RegistroEnfermedadRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'fecha_enfermedad',
        'fecha',
        'active',
        'id_animal',
        'id_enfermedad'
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
        return RegistroEnfermedad::class;
    }
}
