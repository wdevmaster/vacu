<?php

namespace Modules\Animal\Repositories;

use Modules\Animal\Entities\Celo;
use App\Repositories\BaseRepository;

/**
 * Class CeloRepository
 * @package Modules\Animal\Repositories
 * @version July 25, 2020, 3:39 am UTC
*/

class CeloRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'animal_code',
        'fecha',
        'negocio_id',
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
        return Celo::class;
    }
}
