<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 11/05/20
 * Time: 10:14
 */

namespace Modules\Sincronizacion\Dtos;

/**
 * @SWG\Definition(
 *      definition="SincronizacionData",
 *      required={"tabla", "data"},
 *
 *      @SWG\Property(
 *          property="tabla",
 *          description="tabla",
 *          type="string",
 *          example="animales"
 *      ),
 *      @SWG\Property(
 *          property="data",
 *          description="data exactamente igual a la que se tiene que insertar en cualquier tabla en formato json",
 *          type="string",
 *          format="json",
 *      )
 * )
 */
class SincronizacionDataDto
{

    private $table;
    private $data;

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     * @return SincronizacionDataDto
     */
    public function setTable($table): self
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     * @return SincronizacionDataDto
     */
    public function setData($data): self
    {
        $this->data = $data;
        return $this;
    }



}
