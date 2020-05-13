<?php

namespace Modules\CondicionCorporal\Repositories;

use Modules\CondicionCorporal\Entities\CondicionCorporal;
use App\Repositories\BaseRepository;

/**
 * Class CondicionCorporalRepository
 * @package Modules\CondicionCorporal\Repositories
 * @version May 4, 2020, 12:01 pm UTC
*/

class CondicionCorporalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'nombre',
        'descripcion',
        'active',
        'negocio_id'
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
        return CondicionCorporal::class;
    }

    public function delete($id)
    {
       $condicion_corporal = $this->find($id);

       if ($condicion_corporal){
           $condicion_corporal->active = false;
           $this->update($condicion_corporal->toArray(), $id);
       }
       return $condicion_corporal;
    }


}
