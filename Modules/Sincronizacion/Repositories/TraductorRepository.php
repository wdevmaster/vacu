<?php

namespace Modules\Sincronizacion\Repositories;

use Modules\Sincronizacion\Entities\Traductor;
use App\Repositories\BaseRepository;

/**
 * Class TraductorRepository
 * @package Modules\Sincronizacion\Repositories
 * @version May 7, 2020, 5:09 pm UTC
*/

class TraductorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
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
        return Traductor::class;
    }
}
