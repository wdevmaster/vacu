<?php

namespace Modules\Semen\Repositories;

use Modules\Semen\Entities\Semen;
use App\Repositories\BaseRepository;

/**
 * Class SemenRepository
 * @package Modules\Semen\Repositories
 * @version May 4, 2020, 1:57 pm UTC
*/

class SemenRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'active',
        'id_animal'
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
        return Semen::class;
    }
}
