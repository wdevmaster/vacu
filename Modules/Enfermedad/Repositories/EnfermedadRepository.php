<?php

namespace Modules\Enfermedad\Repositories;

use Modules\Enfermedad\Entities\Enfermedad;
use App\Repositories\BaseRepository;

/**
 * Class EnfermedadRepository
 * @package Modules\Enfermedad\Repositories
 * @version May 4, 2020, 12:11 pm UTC
*/

class EnfermedadRepository extends BaseRepository
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
        return Enfermedad::class;
    }
}
