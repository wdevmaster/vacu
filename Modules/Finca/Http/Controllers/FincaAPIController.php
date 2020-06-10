<?php

namespace Modules\Finca\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Finca\Http\Requests\CreateFincaAPIRequest;
use Modules\Finca\Http\Requests\UpdateFincaAPIRequest;
use Modules\Finca\Entities\Finca;
use Modules\Finca\Repositories\FincaRepository;
use Illuminate\Http\Request;

/**
 * Class FincaController
 * @package Modules\Finca\Http\Controllers
 */

class FincaAPIController extends CommonController
{
    /** @var  FincaRepository */
    private $fincaRepository;

    public function __construct(FincaRepository $fincaRepo)
    {
        $this->fincaRepository = $fincaRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/finca/fincas",
     *      summary="Get a listing of the Fincas.",
     *      tags={"Finca"},
     *      description="Get all Fincas",
     *      produces={"application/json"},
     *      @SWG\Parameter(
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
     *                  @SWG\Items(ref="#/definitions/Finca")
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
        if ($paginate){
            $fincas = $this->fincaRepository->paginate($paginate);
        }
        else {
            $fincas = $this->fincaRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
        }



        return $this->sendResponse($fincas->toArray(), 'Fincas retrieved successfully');
    }

    /**
     * @param CreateFincaAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/finca/fincas",
     *      summary="Store a newly created Finca in storage",
     *      tags={"Finca"},
     *      description="Store Finca",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Finca that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Finca")
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
     *                  ref="#/definitions/Finca"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFincaAPIRequest $request)
    {
        $input = $request->all();

        $finca = $this->fincaRepository->create($input);

        return $this->sendResponse($finca->toArray(), 'Finca saved successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/finca/fincas/{id}",
     *      summary="Display the specified Finca",
     *      tags={"Finca"},
     *      description="Get Finca",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Finca",
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
     *                  ref="#/definitions/Finca"
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
        /** @var Finca $finca */
        $finca = $this->fincaRepository->find($id);

        if (empty($finca)) {
            return $this->sendError('Finca not found', 404);
        }

        return $this->sendResponse($finca->toArray(), 'Finca retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateFincaAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/finca/fincas/{id}",
     *      summary="Update the specified Finca in storage",
     *      tags={"Finca"},
     *      description="Update Finca",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Finca",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Finca that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Finca")
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
     *                  ref="#/definitions/Finca"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFincaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Finca $finca */
        $finca = $this->fincaRepository->find($id);

        if (empty($finca)) {
            return $this->sendError('Finca not found', 404);
        }

        $finca = $this->fincaRepository->update($input, $id);

        return $this->sendResponse($finca->toArray(), 'Finca updated successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/api/v1/finca/fincas/{id}",
     *      summary="Remove the specified Finca from storage",
     *      tags={"Finca"},
     *      description="Delete Finca",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Finca",
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
        /** @var Finca $finca */
        $finca = $this->fincaRepository->find($id);

        if (empty($finca)) {
            return $this->sendError('Finca not found', 404);
        }

        $this->fincaRepository->delete($id);

        return $this->sendSuccess('Finca deleted successfully');
    }
}
