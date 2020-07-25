<?php

namespace Modules\Animal\Repositories;

use Modules\Animal\Entities\Tratamiento;
use App\Repositories\BaseRepository;

/**
 * Class TratamientoRepository
 * @package Modules\Animal\Repositories
 * @version July 25, 2020, 4:07 pm UTC
*/

class TratamientoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'animal_code',
        'fecha',
        'negocio_id',
        'nota',
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
        return Tratamiento::class;
    }
}
