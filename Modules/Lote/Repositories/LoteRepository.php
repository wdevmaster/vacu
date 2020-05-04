<?php

namespace Modules\Lote\Repositories;

use Modules\Lote\Entities\Lote;
use App\Repositories\BaseRepository;

/**
 * Class LoteRepository
 * @package Modules\Lote\Repositories
 * @version May 4, 2020, 1:14 pm UTC
*/

class LoteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'lote_id',
        'numero',
        'nombre',
        'active',
        'finca_id'
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
        return Lote::class;
    }
}
