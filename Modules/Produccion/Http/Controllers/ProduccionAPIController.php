<?php

namespace Modules\Produccion\Http\Controllers;

use Modules\Produccion\Http\Requests\CreateProduccionAPIRequest;
use Modules\Produccion\Http\Requests\UpdateProduccionAPIRequest;
use Modules\Produccion\Entities\Produccion;
use Modules\Produccion\Repositories\ProduccionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProduccionController
 * @package Modules\Produccion\Http\Controllers
 */

class ProduccionAPIController extends AppBaseController
{
    /** @var  ProduccionRepository */
    private $produccionRepository;

    public function __construct(ProduccionRepository $produccionRepo)
    {
        $this->produccionRepository = $produccionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/produccions",
     *      summary="Get a listing of the Produccions.",
     *      tags={"Produccion"},
     *      description="Get all Produccions",
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
     *                  @SWG\Items(ref="#/definitions/Produccion")
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
        $produccions = $this->produccionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($produccions->toArray(), 'Produccions retrieved successfully');
    }

    /**
     * @param CreateProduccionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/produccions",
     *      summary="Store a newly created Produccion in storage",
     *      tags={"Produccion"},
     *      description="Store Produccion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Produccion that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Produccion")
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
     *                  ref="#/definitions/Produccion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProduccionAPIRequest $request)
    {
        $input = $request->all();

        $produccion = $this->produccionRepository->create($input);

        return $this->sendResponse($produccion->toArray(), 'Produccion saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/produccions/{id}",
     *      summary="Display the specified Produccion",
     *      tags={"Produccion"},
     *      description="Get Produccion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Produccion",
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
     *                  ref="#/definitions/Produccion"
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
        /** @var Produccion $produccion */
        $produccion = $this->produccionRepository->find($id);

        if (empty($produccion)) {
            return $this->sendError('Produccion not found');
        }

        return $this->sendResponse($produccion->toArray(), 'Produccion retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateProduccionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/produccions/{id}",
     *      summary="Update the specified Produccion in storage",
     *      tags={"Produccion"},
     *      description="Update Produccion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Produccion",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Produccion that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Produccion")
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
     *                  ref="#/definitions/Produccion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProduccionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Produccion $produccion */
        $produccion = $this->produccionRepository->find($id);

        if (empty($produccion)) {
            return $this->sendError('Produccion not found');
        }

        $produccion = $this->produccionRepository->update($input, $id);

        return $this->sendResponse($produccion->toArray(), 'Produccion updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/produccions/{id}",
     *      summary="Remove the specified Produccion from storage",
     *      tags={"Produccion"},
     *      description="Delete Produccion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Produccion",
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
        /** @var Produccion $produccion */
        $produccion = $this->produccionRepository->find($id);

        if (empty($produccion)) {
            return $this->sendError('Produccion not found');
        }

        $produccion->delete();

        return $this->sendSuccess('Produccion deleted successfully');
    }
}
