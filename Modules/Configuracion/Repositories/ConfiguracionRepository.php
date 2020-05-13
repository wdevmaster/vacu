<?php

namespace Modules\Configuracion\Repositories;

use Modules\Configuracion\Entities\Configuracion;
use App\Repositories\BaseRepository;

/**
 * Class ConfiguracionRepository
 * @package Modules\Configuracion\Repositories
 * @version May 4, 2020, 12:07 pm UTC
*/

class ConfiguracionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'configuracion_id',
        'clave',
        'description',
        'valor'
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
        return Configuracion::class;
    }

    /**
     * @param int $id
     * @return bool|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed|null
     */
    public function delete($id)
    {
       $configuracion  = $this->find($id);
       if ($configuracion){
           $configuracion->active = false;
           $this->update($configuracion->toArray(), $configuracion->id);
       }

       return $configuracion;

    }
}
