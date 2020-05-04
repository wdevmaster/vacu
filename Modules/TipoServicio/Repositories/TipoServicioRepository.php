<?php

namespace Modules\TipoServicio\Repositories;

use Modules\TipoServicio\Entities\TipoServicio;
use App\Repositories\BaseRepository;

/**
 * Class TipoServicioRepository
 * @package Modules\TipoServicio\Repositories
 * @version May 4, 2020, 2:08 pm UTC
*/

class TipoServicioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo_servicio_id',
        'nombre',
        'descripcion'
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
        return TipoServicio::class;
    }
}
