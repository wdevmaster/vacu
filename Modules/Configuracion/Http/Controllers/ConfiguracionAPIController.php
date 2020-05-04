<?php

namespace Modules\Configuracion\Http\Controllers;

use Modules\Configuracion\Http\Requests\CreateConfiguracionAPIRequest;
use Modules\Configuracion\Http\Requests\UpdateConfiguracionAPIRequest;
use Modules\Configuracion\Entities\Configuracion;
use Modules\Configuracion\Repositories\ConfiguracionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ConfiguracionController
 * @package Modules\Configuracion\Http\Controllers
 */

class ConfiguracionAPIController extends AppBaseController
{
    /** @var  ConfiguracionRepository */
    private $configuracionRepository;

    public function __construct(ConfiguracionRepository $configuracionRepo)
    {
        $this->configuracionRepository = $configuracionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/configuracions",
     *      summary="Get a listing of the Configuracions.",
     *      tags={"Configuracion"},
     *      description="Get all Configuracions",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Configuracion")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $configuracions = $this->configuracionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($configuracions->toArray(), 'Configuracions retrieved successfully');
    }

    /**
     * @param CreateConfiguracionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/configuracions",
     *      summary="Store a newly created Configuracion in storage",
     *      tags={"Configuracion"},
     *      description="Store Configuracion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Configuracion that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Configuracion")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Configuracion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateConfiguracionAPIRequest $request)
    {
        $input = $request->all();

        $configuracion = $this->configuracionRepository->create($input);

        return $this->sendResponse($configuracion->toArray(), 'Configuracion saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/configuracions/{id}",
     *      summary="Display the specified Configuracion",
     *      tags={"Configuracion"},
     *      description="Get Configuracion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Configuracion",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Configuracion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Configuracion $configuracion */
        $configuracion = $this->configuracionRepository->find($id);

        if (empty($configuracion)) {
            return $this->sendError('Configuracion not found');
        }

        return $this->sendResponse($configuracion->toArray(), 'Configuracion retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateConfiguracionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/configuracions/{id}",
     *      summary="Update the specified Configuracion in storage",
     *      tags={"Configuracion"},
     *      description="Update Configuracion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Configuracion",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Configuracion that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Configuracion")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Configuracion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateConfiguracionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Configuracion $configuracion */
        $configuracion = $this->configuracionRepository->find($id);

        if (empty($configuracion)) {
            return $this->sendError('Configuracion not found');
        }

        $configuracion = $this->configuracionRepository->update($input, $id);

        return $this->sendResponse($configuracion->toArray(), 'Configuracion updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/configuracions/{id}",
     *      summary="Remove the specified Configuracion from storage",
     *      tags={"Configuracion"},
     *      description="Delete Configuracion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Configuracion",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Configuracion $configuracion */
        $configuracion = $this->configuracionRepository->find($id);

        if (empty($configuracion)) {
            return $this->sendError('Configuracion not found');
        }

        $configuracion->delete();

        return $this->sendSuccess('Configuracion deleted successfully');
    }
}
