<?php

namespace Modules\Lactancia\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Lactancia\Entities\Lactancia;
use Modules\Lactancia\Http\Requests\CreateLactanciaAPIRequest;
use Modules\Lactancia\Http\Requests\UpdateLactanciaAPIRequest;
use Modules\Lactancia\Repositories\LactanciaRepository;

/**
 * Class LactanciaController
 * @package Modules\Lactancia\Http\Controllers
 */
class LactanciaAPIController extends CommonController
{
    /** @var  LactanciaRepository */
    private $lactanciaRepository;

    public function __construct(LactanciaRepository $lactanciaRepo)
    {
        $this->lactanciaRepository = $lactanciaRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/lactancia/lactancias",
     *      summary="Get a listing of the Lactancias.",
     *      tags={"Lactancia"},
     *      description="Get all Lactancias",
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
     *                  @SWG\Items(ref="#/definitions/Lactancia")
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
            $lactancias = $this->lactanciaRepository->paginate($paginate);
        } else {
            $lactancias = $this->lactanciaRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
        }


        return $this->sendResponse($lactancias->toArray(), 'Lactancias retrieved successfully');
    }

    /**
     * @param CreateLactanciaAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/lactancia/lactancias",
     *      summary="Store a newly created Lactancia in storage",
     *      tags={"Lactancia"},
     *      description="Store Lactancia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Lactancia that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Lactancia")
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
     *                  ref="#/definitions/Lactancia"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLactanciaAPIRequest $request)
    {
        $input = $request->all();

        $lactancia = $this->lactanciaRepository->create($input);

        return $this->sendResponse($lactancia->toArray(), 'Lactancia saved successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/lactancia/lactancias/{id}",
     *      summary="Display the specified Lactancia",
     *      tags={"Lactancia"},
     *      description="Get Lactancia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Lactancia",
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
     *                  ref="#/definitions/Lactancia"
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
        /** @var Lactancia $lactancia */
        $lactancia = $this->lactanciaRepository->find($id);

        if (empty($lactancia)) {
            return $this->sendError('Lactancia not found', 404);
        }

        return $this->sendResponse($lactancia->toArray(), 'Lactancia retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLactanciaAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/lactancia/lactancias/{id}",
     *      summary="Update the specified Lactancia in storage",
     *      tags={"Lactancia"},
     *      description="Update Lactancia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Lactancia",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Lactancia that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Lactancia")
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
     *                  ref="#/definitions/Lactancia"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLactanciaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Lactancia $lactancia */
        $lactancia = $this->lactanciaRepository->find($id);

        if (empty($lactancia)) {
            return $this->sendError('Lactancia not found', 404);
        }

        $lactancia = $this->lactanciaRepository->update($input, $id);

        return $this->sendResponse($lactancia->toArray(), 'Lactancia updated successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/api/v1/lactancia/lactancias/{id}",
     *      summary="Remove the specified Lactancia from storage",
     *      tags={"Lactancia"},
     *      description="Delete Lactancia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Lactancia",
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
        /** @var Lactancia $lactancia */
        $lactancia = $this->lactanciaRepository->find($id);

        if (empty($lactancia)) {
            return $this->sendError('Lactancia not found', 404);
        }

        $lactancia->delete();

        return $this->sendSuccess('Lactancia deleted successfully');
    }
}
