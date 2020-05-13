<?php

namespace Modules\Animal\Repositories;

use Modules\Animal\Entities\Animal;
use App\Repositories\BaseRepository;

/**
 * Class AnimalRepository
 * @package Modules\Animal\Repositories
 * @version May 4, 2020, 11:13 am UTC
*/

class AnimalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'fecha_nacimiento',
        'sexo',
        'lote_nacimiento_id',
        'madre_codigo',
        'padre_codigo',
        'raza_codigo',
        'lote_actual_id',
        'locomocion_code'
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
        return Animal::class;
    }

    /**
     * @param int $id
     * @return bool|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed|null
     */
    public function delete($id)
    {
        $animal = $this->find($id);

        if ($animal){
            $animal->active = false;
            $this->update($animal->toArray(), $id);
        }
        return $animal;
    }

}
