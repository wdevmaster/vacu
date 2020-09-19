<?php

namespace Modules\Finca\Repositories;

use Modules\Finca\Entities\Finca;
use App\Repositories\BaseRepository;

/**
 * Class FincaRepository
 * @package Modules\Finca\Repositories
 * @version May 4, 2020, 12:44 pm UTC
*/

class FincaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'finca_id',
        'fecha',
        'motivo',
        'nombre',
        'numero',
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
        return Finca::class;
    }

    public function createForWeb($input)
    {

        $code = Finca::getNextCode();
        $new_data = [
            'code' => $code,
            'nombre' => $input['nombre'],
            'numero' => $input['numero'],
            'negocio_id' => $input['negocio_id'],
            'active' => $input['active'],
        ];
        return $this->create($new_data);
    }

    public function delete($id)
    {
        $finca = $this->find($id);

        if ($finca){
            $data_delete = [
                'active' => false
            ];

            $this->update($data_delete, $finca->id);
        }

    }
}
