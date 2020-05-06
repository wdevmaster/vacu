<?php

namespace Modules\Sincronizacion\Repositories;

use Modules\Sincronizacion\Entities\Syncronizacion;
use App\Repositories\BaseRepository;

/**
 * Class SyncronizacionRepository
 * @package Modules\Sincronizacion\Repositories
 * @version May 6, 2020, 4:44 am UTC
*/

class SyncronizacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'table',
        'accion',
        'data',
        'user_id'
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
        return Syncronizacion::class;
    }
}
