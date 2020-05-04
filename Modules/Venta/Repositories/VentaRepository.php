<?php

namespace Modules\Venta\Repositories;

use Modules\Venta\Entities\Venta;
use App\Repositories\BaseRepository;

/**
 * Class VentaRepository
 * @package Modules\Venta\Repositories
 * @version May 4, 2020, 2:12 pm UTC
*/

class VentaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'fecha',
        'motivo',
        'active',
        'animal_id',
        'cliente_id'
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
        return Venta::class;
    }
}
