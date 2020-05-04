<?php

namespace Modules\Venta\Http\Controllers;

use Modules\Venta\Http\Requests\CreateVentaAPIRequest;
use Modules\Venta\Http\Requests\UpdateVentaAPIRequest;
use Modules\Venta\Entities\Venta;
use Modules\Venta\Repositories\VentaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class VentaController
 * @package Modules\Venta\Http\Controllers
 */

class VentaAPIController extends AppBaseController
{
    /** @var  VentaRepository */
    private $ventaRepository;

    public function __construct(VentaRepository $ventaRepo)
    {
        $this->ventaRepository = $ventaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/ventas",
     *      summary="Get a listing of the Ventas.",
     *      tags={"Venta"},
     *      description="Get all Ventas",
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
        $ventas = $this->ventaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($ventas->toArray(), 'Ventas retrieved successfully');
    }

    /**
     * @param CreateVentaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/ventas",
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
     * @return Response
     *
     * @SWG\Get(
     *      path="/ventas/{id}",
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
            return $this->sendError('Venta not found');
        }

        return $this->sendResponse($venta->toArray(), 'Venta retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateVentaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/ventas/{id}",
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
            return $this->sendError('Venta not found');
        }

        $venta = $this->ventaRepository->update($input, $id);

        return $this->sendResponse($venta->toArray(), 'Venta updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/ventas/{id}",
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
            return $this->sendError('Venta not found');
        }

        $venta->delete();

        return $this->sendSuccess('Venta deleted successfully');
    }
}
