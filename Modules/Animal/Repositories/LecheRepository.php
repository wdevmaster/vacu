<?php

namespace Modules\Animal\Repositories;

use Modules\Animal\Entities\Leche;
use App\Repositories\BaseRepository;

/**
 * Class LecheRepository
 * @package Modules\Animal\Repositories
 * @version July 25, 2020, 3:43 pm UTC
*/

class LecheRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'animal_code',
        'peso',
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
        return Leche::class;
    }
}
