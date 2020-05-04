<?php

namespace Modules\Negocio\Http\Controllers;

use Modules\Negocio\Http\Requests\CreateNegocioAPIRequest;
use Modules\Negocio\Http\Requests\UpdateNegocioAPIRequest;
use Modules\Negocio\Entities\Negocio;
use Modules\Negocio\Repositories\NegocioRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class NegocioController
 * @package Modules\Negocio\Http\Controllers
 */

class NegocioAPIController extends AppBaseController
{
    /** @var  NegocioRepository */
    private $negocioRepository;

    public function __construct(NegocioRepository $negocioRepo)
    {
        $this->negocioRepository = $negocioRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/negocios",
     *      summary="Get a listing of the Negocios.",
     *      tags={"Negocio"},
     *      description="Get all Negocios",
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
     *                  @SWG\Items(ref="#/definitions/Negocio")
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
        $negocios = $this->negocioRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($negocios->toArray(), 'Negocios retrieved successfully');
    }

    /**
     * @param CreateNegocioAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/negocios",
     *      summary="Store a newly created Negocio in storage",
     *      tags={"Negocio"},
     *      description="Store Negocio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Negocio that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Negocio")
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
     *                  ref="#/definitions/Negocio"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateNegocioAPIRequest $request)
    {
        $input = $request->all();

        $negocio = $this->negocioRepository->create($input);

        return $this->sendResponse($negocio->toArray(), 'Negocio saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/negocios/{id}",
     *      summary="Display the specified Negocio",
     *      tags={"Negocio"},
     *      description="Get Negocio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Negocio",
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
     *                  ref="#/definitions/Negocio"
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
        /** @var Negocio $negocio */
        $negocio = $this->negocioRepository->find($id);

        if (empty($negocio)) {
            return $this->sendError('Negocio not found');
        }

        return $this->sendResponse($negocio->toArray(), 'Negocio retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateNegocioAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/negocios/{id}",
     *      summary="Update the specified Negocio in storage",
     *      tags={"Negocio"},
     *      description="Update Negocio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Negocio",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Negocio that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Negocio")
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
     *                  ref="#/definitions/Negocio"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateNegocioAPIRequest $request)
    {
        $input = $request->all();

        /** @var Negocio $negocio */
        $negocio = $this->negocioRepository->find($id);

        if (empty($negocio)) {
            return $this->sendError('Negocio not found');
        }

        $negocio = $this->negocioRepository->update($input, $id);

        return $this->sendResponse($negocio->toArray(), 'Negocio updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/negocios/{id}",
     *      summary="Remove the specified Negocio from storage",
     *      tags={"Negocio"},
     *      description="Delete Negocio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Negocio",
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
        /** @var Negocio $negocio */
        $negocio = $this->negocioRepository->find($id);

        if (empty($negocio)) {
            return $this->sendError('Negocio not found');
        }

        $negocio->delete();

        return $this->sendSuccess('Negocio deleted successfully');
    }
}
