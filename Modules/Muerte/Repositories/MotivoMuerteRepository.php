<?php

namespace Modules\Muerte\Repositories;

use Modules\Muerte\Entities\MotivoMuerte;
use App\Repositories\BaseRepository;

/**
 * Class MotivoMuerteRepository
 * @package Modules\Muerte\Repositories
 * @version July 25, 2020, 3:09 am UTC
*/

class MotivoMuerteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'descripcion',
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
        return MotivoMuerte::class;
    }
}
