<?php

namespace Modules\EstadoFisico\Http\Controllers;

use Modules\EstadoFisico\Http\Requests\CreateEstadoFisicoAPIRequest;
use Modules\EstadoFisico\Http\Requests\UpdateEstadoFisicoAPIRequest;
use Modules\EstadoFisico\Entities\EstadoFisico;
use Modules\EstadoFisico\Repositories\EstadoFisicoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EstadoFisicoController
 * @package Modules\EstadoFisico\Http\Controllers
 */

class EstadoFisicoAPIController extends AppBaseController
{
    /** @var  EstadoFisicoRepository */
    private $estadoFisicoRepository;

    public function __construct(EstadoFisicoRepository $estadoFisicoRepo)
    {
        $this->estadoFisicoRepository = $estadoFisicoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/estadoFisicos",
     *      summary="Get a listing of the EstadoFisicos.",
     *      tags={"EstadoFisico"},
     *      description="Get all EstadoFisicos",
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
     *                  @SWG\Items(ref="#/definitions/EstadoFisico")
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
        $estadoFisicos = $this->estadoFisicoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($estadoFisicos->toArray(), 'Estado Fisicos retrieved successfully');
    }

    /**
     * @param CreateEstadoFisicoAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/estadoFisicos",
     *      summary="Store a newly created EstadoFisico in storage",
     *      tags={"EstadoFisico"},
     *      description="Store EstadoFisico",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="EstadoFisico that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/EstadoFisico")
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
     *                  ref="#/definitions/EstadoFisico"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEstadoFisicoAPIRequest $request)
    {
        $input = $request->all();

        $estadoFisico = $this->estadoFisicoRepository->create($input);

        return $this->sendResponse($estadoFisico->toArray(), 'Estado Fisico saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/estadoFisicos/{id}",
     *      summary="Display the specified EstadoFisico",
     *      tags={"EstadoFisico"},
     *      description="Get EstadoFisico",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EstadoFisico",
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
     *                  ref="#/definitions/EstadoFisico"
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
        /** @var EstadoFisico $estadoFisico */
        $estadoFisico = $this->estadoFisicoRepository->find($id);

        if (empty($estadoFisico)) {
            return $this->sendError('Estado Fisico not found');
        }

        return $this->sendResponse($estadoFisico->toArray(), 'Estado Fisico retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateEstadoFisicoAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/estadoFisicos/{id}",
     *      summary="Update the specified EstadoFisico in storage",
     *      tags={"EstadoFisico"},
     *      description="Update EstadoFisico",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EstadoFisico",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="EstadoFisico that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/EstadoFisico")
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
     *                  ref="#/definitions/EstadoFisico"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEstadoFisicoAPIRequest $request)
    {
        $input = $request->all();

        /** @var EstadoFisico $estadoFisico */
        $estadoFisico = $this->estadoFisicoRepository->find($id);

        if (empty($estadoFisico)) {
            return $this->sendError('Estado Fisico not found');
        }

        $estadoFisico = $this->estadoFisicoRepository->update($input, $id);

        return $this->sendResponse($estadoFisico->toArray(), 'EstadoFisico updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/estadoFisicos/{id}",
     *      summary="Remove the specified EstadoFisico from storage",
     *      tags={"EstadoFisico"},
     *      description="Delete EstadoFisico",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EstadoFisico",
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
        /** @var EstadoFisico $estadoFisico */
        $estadoFisico = $this->estadoFisicoRepository->find($id);

        if (empty($estadoFisico)) {
            return $this->sendError('Estado Fisico not found');
        }

        $estadoFisico->delete();

        return $this->sendSuccess('Estado Fisico deleted successfully');
    }
}
