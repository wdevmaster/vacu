<?php

namespace Modules\Muerte\Repositories;

use Modules\Muerte\Entities\Muerte;
use App\Repositories\BaseRepository;

/**
 * Class MuerteRepository
 * @package Modules\Muerte\Repositories
 * @version May 4, 2020, 1:18 pm UTC
*/

class MuerteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'fecha',
        'motivo_id',
        'animal_id'
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
        return Muerte::class;
    }
}
