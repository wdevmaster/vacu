<?php

namespace Modules\Animal\Repositories;

use Modules\Animal\Entities\Palpacion;
use App\Repositories\BaseRepository;

/**
 * Class PalpacionRepository
 * @package Modules\Animal\Repositories
 * @version July 25, 2020, 3:00 pm UTC
*/

class PalpacionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'animal_code',
        'celo',
        'fecha',
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
        return Palpacion::class;
    }
}
