<?php

namespace Modules\Parto\Repositories;

use Modules\Parto\Entities\Parto;
use App\Repositories\BaseRepository;

/**
 * Class PartoRepository
 * @package Modules\Parto\Repositories
 * @version May 4, 2020, 1:28 pm UTC
*/

class PartoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'fecha',
        'sexo',
        'animal_nacido',
        'madre_code',
        'active',
        'raza_id'
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
        return Parto::class;
    }
}
