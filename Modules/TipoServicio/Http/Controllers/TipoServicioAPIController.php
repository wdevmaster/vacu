<?php

namespace Modules\TipoServicio\Http\Controllers;

use Modules\TipoServicio\Http\Requests\CreateTipoServicioAPIRequest;
use Modules\TipoServicio\Http\Requests\UpdateTipoServicioAPIRequest;
use Modules\TipoServicio\Entities\TipoServicio;
use Modules\TipoServicio\Repositories\TipoServicioRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TipoServicioController
 * @package Modules\TipoServicio\Http\Controllers
 */

class TipoServicioAPIController extends AppBaseController
{
    /** @var  TipoServicioRepository */
    private $tipoServicioRepository;

    public function __construct(TipoServicioRepository $tipoServicioRepo)
    {
        $this->tipoServicioRepository = $tipoServicioRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/tipoServicios",
     *      summary="Get a listing of the TipoServicios.",
     *      tags={"TipoServicio"},
     *      description="Get all TipoServicios",
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
     *                  @SWG\Items(ref="#/definitions/TipoServicio")
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
        $tipoServicios = $this->tipoServicioRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($tipoServicios->toArray(), 'Tipo Servicios retrieved successfully');
    }

    /**
     * @param CreateTipoServicioAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/tipoServicios",
     *      summary="Store a newly created TipoServicio in storage",
     *      tags={"TipoServicio"},
     *      description="Store TipoServicio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TipoServicio that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TipoServicio")
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
     *                  ref="#/definitions/TipoServicio"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTipoServicioAPIRequest $request)
    {
        $input = $request->all();

        $tipoServicio = $this->tipoServicioRepository->create($input);

        return $this->sendResponse($tipoServicio->toArray(), 'Tipo Servicio saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/tipoServicios/{id}",
     *      summary="Display the specified TipoServicio",
     *      tags={"TipoServicio"},
     *      description="Get TipoServicio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TipoServicio",
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
     *                  ref="#/definitions/TipoServicio"
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
        /** @var TipoServicio $tipoServicio */
        $tipoServicio = $this->tipoServicioRepository->find($id);

        if (empty($tipoServicio)) {
            return $this->sendError('Tipo Servicio not found');
        }

        return $this->sendResponse($tipoServicio->toArray(), 'Tipo Servicio retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTipoServicioAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/tipoServicios/{id}",
     *      summary="Update the specified TipoServicio in storage",
     *      tags={"TipoServicio"},
     *      description="Update TipoServicio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TipoServicio",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TipoServicio that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TipoServicio")
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
     *                  ref="#/definitions/TipoServicio"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTipoServicioAPIRequest $request)
    {
        $input = $request->all();

        /** @var TipoServicio $tipoServicio */
        $tipoServicio = $this->tipoServicioRepository->find($id);

        if (empty($tipoServicio)) {
            return $this->sendError('Tipo Servicio not found');
        }

        $tipoServicio = $this->tipoServicioRepository->update($input, $id);

        return $this->sendResponse($tipoServicio->toArray(), 'TipoServicio updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/tipoServicios/{id}",
     *      summary="Remove the specified TipoServicio from storage",
     *      tags={"TipoServicio"},
     *      description="Delete TipoServicio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TipoServicio",
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
        /** @var TipoServicio $tipoServicio */
        $tipoServicio = $this->tipoServicioRepository->find($id);

        if (empty($tipoServicio)) {
            return $this->sendError('Tipo Servicio not found');
        }

        $tipoServicio->delete();

        return $this->sendSuccess('Tipo Servicio deleted successfully');
    }
}
