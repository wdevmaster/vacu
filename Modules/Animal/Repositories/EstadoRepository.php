<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 26/06/20
 * Time: 10:21
 */

namespace Modules\Animal\Repositories;


use Modules\Animal\Entities\Estado;

class EstadoRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
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
        return Estado::class;
    }

}
