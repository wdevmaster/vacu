<?php

namespace Modules\Produccion\Repositories;

use Modules\Produccion\Entities\Produccion;
use App\Repositories\BaseRepository;

/**
 * Class ProduccionRepository
 * @package Modules\Produccion\Repositories
 * @version May 4, 2020, 1:32 pm UTC
*/

class ProduccionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'fecha',
        'peso',
        'active',
        'animal_id'
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
        return Produccion::class;
    }
}
