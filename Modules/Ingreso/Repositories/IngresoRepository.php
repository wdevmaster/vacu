<?php

namespace Modules\Ingreso\Repositories;

use Modules\Ingreso\Entities\Ingreso;
use App\Repositories\BaseRepository;

/**
 * Class IngresoRepository
 * @package Modules\Ingreso\Repositories
 * @version May 4, 2020, 12:53 pm UTC
*/

class IngresoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'fecha',
        'active',
        'animal_id',
        'lote_id'
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
        return Ingreso::class;
    }
}
