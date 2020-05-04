<?php

namespace Modules\Servicio\Http\Controllers;

use Modules\Servicio\Http\Requests\CreateServicioAPIRequest;
use Modules\Servicio\Http\Requests\UpdateServicioAPIRequest;
use Modules\Servicio\Entities\Servicio;
use Modules\Servicio\Repositories\ServicioRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ServicioController
 * @package Modules\Servicio\Http\Controllers
 */

class ServicioAPIController extends AppBaseController
{
    /** @var  ServicioRepository */
    private $servicioRepository;

    public function __construct(ServicioRepository $servicioRepo)
    {
        $this->servicioRepository = $servicioRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/servicios",
     *      summary="Get a listing of the Servicios.",
     *      tags={"Servicio"},
     *      description="Get all Servicios",
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
     *                  @SWG\Items(ref="#/definitions/Servicio")
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
        $servicios = $this->servicioRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($servicios->toArray(), 'Servicios retrieved successfully');
    }

    /**
     * @param CreateServicioAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/servicios",
     *      summary="Store a newly created Servicio in storage",
     *      tags={"Servicio"},
     *      description="Store Servicio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Servicio that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Servicio")
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
     *                  ref="#/definitions/Servicio"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateServicioAPIRequest $request)
    {
        $input = $request->all();

        $servicio = $this->servicioRepository->create($input);

        return $this->sendResponse($servicio->toArray(), 'Servicio saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/servicios/{id}",
     *      summary="Display the specified Servicio",
     *      tags={"Servicio"},
     *      description="Get Servicio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Servicio",
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
     *                  ref="#/definitions/Servicio"
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
        /** @var Servicio $servicio */
        $servicio = $this->servicioRepository->find($id);

        if (empty($servicio)) {
            return $this->sendError('Servicio not found');
        }

        return $this->sendResponse($servicio->toArray(), 'Servicio retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateServicioAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/servicios/{id}",
     *      summary="Update the specified Servicio in storage",
     *      tags={"Servicio"},
     *      description="Update Servicio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Servicio",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Servicio that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Servicio")
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
     *                  ref="#/definitions/Servicio"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateServicioAPIRequest $request)
    {
        $input = $request->all();

        /** @var Servicio $servicio */
        $servicio = $this->servicioRepository->find($id);

        if (empty($servicio)) {
            return $this->sendError('Servicio not found');
        }

        $servicio = $this->servicioRepository->update($input, $id);

        return $this->sendResponse($servicio->toArray(), 'Servicio updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/servicios/{id}",
     *      summary="Remove the specified Servicio from storage",
     *      tags={"Servicio"},
     *      description="Delete Servicio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Servicio",
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
        /** @var Servicio $servicio */
        $servicio = $this->servicioRepository->find($id);

        if (empty($servicio)) {
            return $this->sendError('Servicio not found');
        }

        $servicio->delete();

        return $this->sendSuccess('Servicio deleted successfully');
    }
}
