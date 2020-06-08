<?php

namespace Modules\Venta\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Venta\Entities\Venta;
use Modules\Venta\Http\Requests\CreateVentaAPIRequest;
use Modules\Venta\Http\Requests\UpdateVentaAPIRequest;
use Modules\Venta\Repositories\VentaRepository;

/**
 * Class VentaController
 * @package Modules\Venta\Http\Controllers
 */
class VentaAPIController extends CommonController
{
    /** @var  VentaRepository */
    private $ventaRepository;

    public function __construct(VentaRepository $ventaRepo)
    {
        $this->ventaRepository = $ventaRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/venta/ventas",
     *      summary="Get a listing of the Ventas.",
     *      tags={"Venta"},
     *      description="Get all Ventas",
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
     *                  @SWG\Items(ref="#/definitions/Venta")
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
            $ventas = $this->ventaRepository->paginate($paginate);
        } else {
            $ventas = $this->ventaRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
        }


        return $this->sendResponse($ventas->toArray(), 'Ventas retrieved successfully');
    }

    /**
     * @param CreateVentaAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/venta/ventas",
     *      summary="Store a newly created Venta in storage",
     *      tags={"Venta"},
     *      description="Store Venta",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Venta that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Venta")
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
     *                  ref="#/definitions/Venta"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateVentaAPIRequest $request)
    {
        $input = $request->all();

        $venta = $this->ventaRepository->create($input);

        return $this->sendResponse($venta->toArray(), 'Venta saved successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/venta/ventas/{id}",
     *      summary="Display the specified Venta",
     *      tags={"Venta"},
     *      description="Get Venta",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Venta",
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
     *                  ref="#/definitions/Venta"
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
        /** @var Venta $venta */
        $venta = $this->ventaRepository->find($id);

        if (empty($venta)) {
            return $this->sendError('Venta not found', 404);
        }

        return $this->sendResponse($venta->toArray(), 'Venta retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateVentaAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/venta/ventas/{id}",
     *      summary="Update the specified Venta in storage",
     *      tags={"Venta"},
     *      description="Update Venta",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Venta",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Venta that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Venta")
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
     *                  ref="#/definitions/Venta"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateVentaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Venta $venta */
        $venta = $this->ventaRepository->find($id);

        if (empty($venta)) {
            return $this->sendError('Venta not found', 404);
        }

        $venta = $this->ventaRepository->update($input, $id);

        return $this->sendResponse($venta->toArray(), 'Venta updated successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/api/v1/venta/ventas/{id}",
     *      summary="Remove the specified Venta from storage",
     *      tags={"Venta"},
     *      description="Delete Venta",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Venta",
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
        /** @var Venta $venta */
        $venta = $this->ventaRepository->find($id);

        if (empty($venta)) {
            return $this->sendError('Venta not found', 404);
        }

        $venta->delete();

        return $this->sendSuccess('Venta deleted successfully');
    }
}
