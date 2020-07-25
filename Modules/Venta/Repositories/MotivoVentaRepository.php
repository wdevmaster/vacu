<?php

namespace Modules\Venta\Repositories;

use Modules\Venta\Entities\MotivoVenta;
use App\Repositories\BaseRepository;

/**
 * Class MotivoVentaRepository
 * @package Modules\Venta\Repositories
 * @version July 25, 2020, 2:23 am UTC
*/

class MotivoVentaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion',
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
        return MotivoVenta::class;
    }
}
