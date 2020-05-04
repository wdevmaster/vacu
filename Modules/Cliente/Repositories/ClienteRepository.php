<?php

namespace Modules\Cliente\Repositories;

use Modules\Cliente\Entities\Cliente;
use App\Repositories\BaseRepository;

/**
 * Class ClienteRepository
 * @package Modules\Cliente\Repositories
 * @version May 4, 2020, 11:54 am UTC
*/

class ClienteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'nombre',
        'descripcion',
        'telfono',
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
        return Cliente::class;
    }
}
