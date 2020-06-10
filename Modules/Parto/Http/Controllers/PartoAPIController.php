<?php

namespace Modules\Parto\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Parto\Entities\Parto;
use Modules\Parto\Http\Requests\CreatePartoAPIRequest;
use Modules\Parto\Http\Requests\UpdatePartoAPIRequest;
use Modules\Parto\Repositories\PartoRepository;

/**
 * Class PartoController
 * @package Modules\Parto\Http\Controllers
 */
class PartoAPIController extends CommonController
{
    /** @var  PartoRepository */
    private $partoRepository;

    public function __construct(PartoRepository $partoRepo)
    {
        $this->partoRepository = $partoRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/parto/partos",
     *      summary="Get a listing of the Partos.",
     *      tags={"Parto"},
     *      description="Get all Partos",
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
     *                  @SWG\Items(ref="#/definitions/Parto")
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
            $partos = $this->partoRepository->paginate($paginate);
        } else {
            $partos = $this->partoRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
        }


        return $this->sendResponse($partos->toArray(), 'Partos retrieved successfully');
    }

    /**
     * @param CreatePartoAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/parto/partos",
     *      summary="Store a newly created Parto in storage",
     *      tags={"Parto"},
     *      description="Store Parto",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Parto that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Parto")
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
     *                  ref="#/definitions/Parto"
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
    public function store(CreatePartoAPIRequest $request)
    {
        $input = $request->all();

        $parto = $this->partoRepository->create($input);

        return $this->sendResponse($parto->toArray(), 'Parto saved successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/parto/partos/{id}",
     *      summary="Display the specified Parto",
     *      tags={"Parto"},
     *      description="Get Parto",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Parto",
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
     *                  ref="#/definitions/Parto"
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
        /** @var Parto $parto */
        $parto = $this->partoRepository->find($id);

        if (empty($parto)) {
            return $this->sendError('Parto not found', 404);
        }

        return $this->sendResponse($parto->toArray(), 'Parto retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePartoAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/parto/partos/{id}",
     *      summary="Update the specified Parto in storage",
     *      tags={"Parto"},
     *      description="Update Parto",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Parto",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Parto that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Parto")
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
     *                  ref="#/definitions/Parto"
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
    public function update($id, UpdatePartoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Parto $parto */
        $parto = $this->partoRepository->find($id);

        if (empty($parto)) {
            return $this->sendError('Parto not found', 404);
        }

        $parto = $this->partoRepository->update($input, $id);

        return $this->sendResponse($parto->toArray(), 'Parto updated successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/api/v1/parto/partos/{id}",
     *      summary="Remove the specified Parto from storage",
     *      tags={"Parto"},
     *      description="Delete Parto",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Parto",
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
        /** @var Parto $parto */
        $parto = $this->partoRepository->find($id);

        if (empty($parto)) {
            return $this->sendError('Parto not found', 404);
        }

        $parto->delete();

        return $this->sendSuccess('Parto deleted successfully');
    }
}
