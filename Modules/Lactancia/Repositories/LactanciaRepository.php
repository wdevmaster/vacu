<?php

namespace Modules\Lactancia\Repositories;

use Modules\Lactancia\Entities\Lactancia;
use App\Repositories\BaseRepository;

/**
 * Class LactanciaRepository
 * @package Modules\Lactancia\Repositories
 * @version May 4, 2020, 1:05 pm UTC
*/

class LactanciaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'fecha',
        'leche',
        'concentrado',
        'peso',
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
        return Lactancia::class;
    }
}
