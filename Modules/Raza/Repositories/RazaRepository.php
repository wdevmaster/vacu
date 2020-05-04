<?php

namespace Modules\Raza\Repositories;

use Modules\Raza\Entities\Raza;
use App\Repositories\BaseRepository;

/**
 * Class RazaRepository
 * @package Modules\Raza\Repositories
 * @version May 4, 2020, 1:51 pm UTC
*/

class RazaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
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
        return Raza::class;
    }
}
