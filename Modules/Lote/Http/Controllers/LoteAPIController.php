<?php

namespace Modules\Lote\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Lote\Entities\Lote;
use Modules\Lote\Http\Requests\CreateLoteAPIRequest;
use Modules\Lote\Http\Requests\UpdateLoteAPIRequest;
use Modules\Lote\Repositories\LoteRepository;

/**
 * Class LoteController
 * @package Modules\Lote\Http\Controllers
 */
class LoteAPIController extends CommonController
{
    /** @var  LoteRepository */
    private $loteRepository;

    public function __construct(LoteRepository $loteRepo)
    {
        $this->loteRepository = $loteRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/lote/lotes",
     *      summary="Get a listing of the Lotes.",
     *      tags={"Lote"},
     *      description="Get all Lotes",
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
     *                  @SWG\Items(ref="#/definitions/Lote")
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
            $lotes = $this->loteRepository->paginate($paginate);
        } else {
            $lotes = $this->loteRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
        }

        return $this->sendResponse($lotes->toArray(), 'Lotes retrieved successfully');
    }

    /**
     * @param CreateLoteAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/lote/lotes",
     *      summary="Store a newly created Lote in storage",
     *      tags={"Lote"},
     *      description="Store Lote",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Lote that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Lote")
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
     *                  ref="#/definitions/Lote"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLoteAPIRequest $request)
    {
        $input = $request->all();

        $lote = $this->loteRepository->create($input);

        return $this->sendResponse($lote->toArray(), 'Lote saved successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/lote/lotes/{id}",
     *      summary="Display the specified Lote",
     *      tags={"Lote"},
     *      description="Get Lote",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Lote",
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
     *                  ref="#/definitions/Lote"
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
        /** @var Lote $lote */
        $lote = $this->loteRepository->find($id);

        if (empty($lote)) {
            return $this->sendError('Lote not found', 404);
        }

        return $this->sendResponse($lote->toArray(), 'Lote retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLoteAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/lote/lotes/{id}",
     *      summary="Update the specified Lote in storage",
     *      tags={"Lote"},
     *      description="Update Lote",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Lote",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Lote that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Lote")
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
     *                  ref="#/definitions/Lote"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLoteAPIRequest $request)
    {
        $input = $request->all();

        /** @var Lote $lote */
        $lote = $this->loteRepository->find($id);

        if (empty($lote)) {
            return $this->sendError('Lote not found', 404);
        }

        $lote = $this->loteRepository->update($input, $id);

        return $this->sendResponse($lote->toArray(), 'Lote updated successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/api/v1/lote/lotes/{id}",
     *      summary="Remove the specified Lote from storage",
     *      tags={"Lote"},
     *      description="Delete Lote",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Lote",
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
        /** @var Lote $lote */
        $lote = $this->loteRepository->find($id);

        if (empty($lote)) {
            return $this->sendError('Lote not found', 404);
        }

        $lote->delete();

        return $this->sendSuccess('Lote deleted successfully');
    }
}
