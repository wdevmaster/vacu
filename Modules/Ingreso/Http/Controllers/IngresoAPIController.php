<?php

namespace Modules\Ingreso\Http\Controllers;

use Modules\Ingreso\Http\Requests\CreateIngresoAPIRequest;
use Modules\Ingreso\Http\Requests\UpdateIngresoAPIRequest;
use Modules\Ingreso\Entities\Ingreso;
use Modules\Ingreso\Repositories\IngresoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class IngresoController
 * @package Modules\Ingreso\Http\Controllers
 */

class IngresoAPIController extends AppBaseController
{
    /** @var  IngresoRepository */
    private $ingresoRepository;

    public function __construct(IngresoRepository $ingresoRepo)
    {
        $this->ingresoRepository = $ingresoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/api/v1/ingreso/ingresos",
     *      summary="Get a listing of the Ingresos.",
     *      tags={"Ingreso"},
     *      description="Get all Ingresos",
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
     *                  @SWG\Items(ref="#/definitions/Ingreso")
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
        $ingresos = $this->ingresoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($ingresos->toArray(), 'Ingresos retrieved successfully');
    }

    /**
     * @param CreateIngresoAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/api/v1/ingreso/ingresos",
     *      summary="Store a newly created Ingreso in storage",
     *      tags={"Ingreso"},
     *      description="Store Ingreso",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Ingreso that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Ingreso")
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
     *                  ref="#/definitions/Ingreso"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateIngresoAPIRequest $request)
    {
        $input = $request->all();

        $ingreso = $this->ingresoRepository->create($input);

        return $this->sendResponse($ingreso->toArray(), 'Ingreso saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/api/v1/ingreso/ingresos/{id}",
     *      summary="Display the specified Ingreso",
     *      tags={"Ingreso"},
     *      description="Get Ingreso",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Ingreso",
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
     *                  ref="#/definitions/Ingreso"
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
        /** @var Ingreso $ingreso */
        $ingreso = $this->ingresoRepository->find($id);

        if (empty($ingreso)) {
            return $this->sendError('Ingreso not found');
        }

        return $this->sendResponse($ingreso->toArray(), 'Ingreso retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateIngresoAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/api/v1/ingreso/ingresos/{id}",
     *      summary="Update the specified Ingreso in storage",
     *      tags={"Ingreso"},
     *      description="Update Ingreso",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Ingreso",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Ingreso that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Ingreso")
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
     *                  ref="#/definitions/Ingreso"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateIngresoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Ingreso $ingreso */
        $ingreso = $this->ingresoRepository->find($id);

        if (empty($ingreso)) {
            return $this->sendError('Ingreso not found');
        }

        $ingreso = $this->ingresoRepository->update($input, $id);

        return $this->sendResponse($ingreso->toArray(), 'Ingreso updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/api/v1/ingreso/ingresos/{id}",
     *      summary="Remove the specified Ingreso from storage",
     *      tags={"Ingreso"},
     *      description="Delete Ingreso",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Ingreso",
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
        /** @var Ingreso $ingreso */
        $ingreso = $this->ingresoRepository->find($id);

        if (empty($ingreso)) {
            return $this->sendError('Ingreso not found');
        }

        $ingreso->delete();

        return $this->sendSuccess('Ingreso deleted successfully');
    }
}
