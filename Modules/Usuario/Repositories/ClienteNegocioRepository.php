<?php

namespace Modules\Usuario\Repositories;

use Modules\Usuario\Entities\ClienteNegocio;
use App\Repositories\BaseRepository;


/**
 * Class ClienteNegocioRepository
 * @package Modules\Usuario\Repositories
 * @version May 28, 2020, 11:26 pm UTC
*/

class ClienteNegocioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'nombre',
        'descripcion',
        'telefono',
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
        return ClienteNegocio::class;
    }


}
