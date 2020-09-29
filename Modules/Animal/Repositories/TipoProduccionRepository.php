<?php

namespace Modules\Animal\Repositories;

use Modules\Animal\Entities\TipoProduccion;
use App\Repositories\BaseRepository;

/**
 * Class TipoProduccionRepository
 * @package Modules\Animal\Repositories
 * @version September 29, 2020, 12:07 pm UTC
*/

class TipoProduccionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return TipoProduccion::class;
    }
}
