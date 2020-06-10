<?php

namespace Modules\Locomocion\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Locomocion\Entities\Locomocion;
use Modules\Locomocion\Http\Requests\CreateLocomocionAPIRequest;
use Modules\Locomocion\Http\Requests\UpdateLocomocionAPIRequest;
use Modules\Locomocion\Repositories\LocomocionRepository;

/**
 * Class LocomocionController
 * @package Modules\Locomocion\Http\Controllers
 */
class LocomocionAPIController extends CommonController
{
    /** @var  LocomocionRepository */
    private $locomocionRepository;

    public function __construct(LocomocionRepository $locomocionRepo)
    {
        $this->locomocionRepository = $locomocionRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/locomocion/locomociones",
     *      summary="Get a listing of the Locomocions.",
     *      tags={"Locomocion"},
     *      description="Get all Locomocions",
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
     *                  @SWG\Items(ref="#/definitions/Locomocion")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *      security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function index(Request $request)
    {
        $paginate = isset($request->paginado) ? $request->paginado : null;
        if ($paginate) {
            $locomocions = $this->locomocionRepository->paginate($paginate);
        } else {
            $locomocions = $this->locomocionRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
        }


        return $this->sendResponse($locomocions->toArray(), 'Locomocions retrieved successfully');
    }

    /**
     * @param CreateLocomocionAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/locomocion/locomociones",
     *      summary="Store a newly created Locomocion in storage",
     *      tags={"Locomocion"},
     *      description="Store Locomocion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Locomocion that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Locomocion")
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
     *                  ref="#/definitions/Locomocion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *      security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function store(CreateLocomocionAPIRequest $request)
    {
        $input = $request->all();

        $locomocion = $this->locomocionRepository->create($input);

        return $this->sendResponse($locomocion->toArray(), 'Locomocion saved successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/locomocion/locomociones/{id}",
     *      summary="Display the specified Locomocion",
     *      tags={"Locomocion"},
     *      description="Get Locomocion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Locomocion",
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
     *                  ref="#/definitions/Locomocion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *      security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function show($id)
    {
        /** @var Locomocion $locomocion */
        $locomocion = $this->locomocionRepository->find($id);

        if (empty($locomocion)) {
            return $this->sendError('Locomocion not found', 404);
        }

        return $this->sendResponse($locomocion->toArray(), 'Locomocion retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLocomocionAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/locomocion/locomociones/{id}",
     *      summary="Update the specified Locomocion in storage",
     *      tags={"Locomocion"},
     *      description="Update Locomocion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Locomocion",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Locomocion that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Locomocion")
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
     *                  ref="#/definitions/Locomocion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *      security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function update($id, UpdateLocomocionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Locomocion $locomocion */
        $locomocion = $this->locomocionRepository->find($id);

        if (empty($locomocion)) {
            return $this->sendError('Locomocion not found', 404);
        }

        $locomocion = $this->locomocionRepository->update($input, $id);

        return $this->sendResponse($locomocion->toArray(), 'Locomocion updated successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/api/v1/locomocion/locomociones/{id}",
     *      summary="Remove the specified Locomocion from storage",
     *      tags={"Locomocion"},
     *      description="Delete Locomocion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Locomocion",
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
     *      ),
     *      security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function destroy($id)
    {
        /** @var Locomocion $locomocion */
        $locomocion = $this->locomocionRepository->find($id);

        if (empty($locomocion)) {
            return $this->sendError('Locomocion not found', 404);
        }

        $locomocion->delete();

        return $this->sendSuccess('Locomocion deleted successfully');
    }
}
