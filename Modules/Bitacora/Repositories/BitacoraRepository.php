<?php

namespace Modules\Bitacora\Repositories;

use Modules\Bitacora\Entities\Bitacora;
use App\Repositories\BaseRepository;

/**
 * Class BitacoraRepository
 * @package Modules\Bitacora\Repositories
 * @version July 9, 2020, 2:56 am UTC
*/

class BitacoraRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'fecha_generacion',
        'codigo_usuario',
        'codigo_generado',
        'entidad',
        'usuario_id'
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
        return Bitacora::class;
    }
}
