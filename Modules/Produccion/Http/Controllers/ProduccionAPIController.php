<?php

namespace Modules\Produccion\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Produccion\Entities\Produccion;
use Modules\Produccion\Http\Requests\CreateProduccionAPIRequest;
use Modules\Produccion\Http\Requests\UpdateProduccionAPIRequest;
use Modules\Produccion\Repositories\ProduccionRepository;

/**
 * Class ProduccionController
 * @package Modules\Produccion\Http\Controllers
 */
class ProduccionAPIController extends CommonController
{
    /** @var  ProduccionRepository */
    private $produccionRepository;

    public function __construct(ProduccionRepository $produccionRepo)
    {
        $this->produccionRepository = $produccionRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/produccion/producciones",
     *      summary="Get a listing of the Produccions.",
     *      tags={"Produccion"},
     *      description="Get all Produccions",
     *      produces={"application/json"},
     *     @SWG\Parameter(
     *          name="paginado",
     *          in="query",
     *          type="integer",
     *          description="Paginado",
     *          required=false,
     *          @SWG\Schema(
     *               @SWG\Property(
     *                  property="paginate",
     *                  type="integer"
     *              ),
     *         )
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

        $paginate = isset($request->paginado) ? $request->paginado : null;
        if ($paginate) {
            $produccions = $this->produccionRepository->paginate($paginate);
        } else {
            $produccions = $this->produccionRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
        }


        return $this->sendResponse($produccions->toArray(), 'Produccions retrieved successfully');
    }

    /**
     * @param CreateProduccionAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/produccion/producciones",
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
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/produccion/producciones/{id}",
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
            return $this->sendError('Produccion not found', 404);
        }

        return $this->sendResponse($produccion->toArray(), 'Produccion retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateProduccionAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/produccion/producciones/{id}",
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
            return $this->sendError('Produccion not found', 404);
        }

        $produccion = $this->produccionRepository->update($input, $id);

        return $this->sendResponse($produccion->toArray(), 'Produccion updated successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/api/v1/produccion/producciones/{id}",
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
            return $this->sendError('Produccion not found', 404);
        }

        $produccion->delete();

        return $this->sendSuccess('Produccion deleted successfully');
    }
}
