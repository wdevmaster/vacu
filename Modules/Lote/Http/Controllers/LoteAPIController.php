<?php

namespace Modules\Lote\Http\Controllers;

use Modules\Lote\Http\Requests\CreateLoteAPIRequest;
use Modules\Lote\Http\Requests\UpdateLoteAPIRequest;
use Modules\Lote\Entities\Lote;
use Modules\Lote\Repositories\LoteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class LoteController
 * @package Modules\Lote\Http\Controllers
 */

class LoteAPIController extends AppBaseController
{
    /** @var  LoteRepository */
    private $loteRepository;

    public function __construct(LoteRepository $loteRepo)
    {
        $this->loteRepository = $loteRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/api/v1/lote/lotes",
     *      summary="Get a listing of the Lotes.",
     *      tags={"Lote"},
     *      description="Get all Lotes",
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
        $lotes = $this->loteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($lotes->toArray(), 'Lotes retrieved successfully');
    }

    /**
     * @param CreateLoteAPIRequest $request
     * @return Response
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
     * @return Response
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
            return $this->sendError('Lote not found');
        }

        return $this->sendResponse($lote->toArray(), 'Lote retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLoteAPIRequest $request
     * @return Response
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
            return $this->sendError('Lote not found');
        }

        $lote = $this->loteRepository->update($input, $id);

        return $this->sendResponse($lote->toArray(), 'Lote updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
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
            return $this->sendError('Lote not found');
        }

        $lote->delete();

        return $this->sendSuccess('Lote deleted successfully');
    }
}
