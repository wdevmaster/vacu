<?php

namespace Modules\Venta\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Venta\Http\Requests\CreateMotivoVentaAPIRequest;
use Modules\Venta\Http\Requests\UpdateMotivoVentaAPIRequest;
use Modules\Venta\Entities\MotivoVenta;
use Modules\Venta\Repositories\MotivoVentaRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class MotivoVentaController
 * @package Modules\Venta\Http\Controllers
 */

class MotivoVentaAPIController extends CommonController
{
    /** @var  MotivoVentaRepository */
    private $motivoVentaRepository;

    public function __construct(MotivoVentaRepository $motivoVentaRepo)
    {
        $this->motivoVentaRepository = $motivoVentaRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/venta/motivo_ventas",
     *      summary="Get a listing of the MotivoVentas.",
     *      tags={"MotivoVenta"},
     *      description="Get all MotivoVentas",
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
     *                  @SWG\Items(ref="#/definitions/MotivoVenta")
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
        try{

            $paginate = isset($request->paginado) ? $request->paginado : null;
            if ($paginate) {
                $motivoVentas = $this->motivoVentaRepository->paginate($paginate);
            } else {
        $motivoVentas = $this->motivoVentaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );
            }

            return $this->sendResponse($motivoVentas->toArray(),
                'comun::msgs.la_model_list_successfully',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                false,
                500);
        }
    }

    /**
     * @param CreateMotivoVentaAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/venta/motivo_ventas",
     *      summary="Store a newly created MotivoVenta in storage",
     *      tags={"MotivoVenta"},
     *      description="Store MotivoVenta",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MotivoVenta that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MotivoVenta")
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
     *                  ref="#/definitions/MotivoVenta"
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
    public function store(CreateMotivoVentaAPIRequest $request)
    {
        try{
        $input = $request->all();

        $motivoVenta = $this->motivoVentaRepository->create($input);

            return $this->sendResponse($motivoVenta->toArray(),
                'comun::msgs.la_model_saved_successfully',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                false,
                500);
        }
    }


    /**
     * @param int $id
     * @param UpdateMotivoVentaAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/venta/motivo_ventas/{id}",
     *      summary="Update the specified MotivoVenta in storage",
     *      tags={"MotivoVenta"},
     *      description="Update MotivoVenta",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MotivoVenta",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MotivoVenta that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MotivoVenta")
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
     *                  ref="#/definitions/MotivoVenta"
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
    public function update($id, UpdateMotivoVentaAPIRequest $request)
    {
        try{
        $input = $request->all();

        /** @var MotivoVenta $motivoVenta */
        $this->motivoVentaRepository->find($id);

        $motivoVenta = $this->motivoVentaRepository->update($input, $id);

            return $this->sendResponse($motivoVenta->toArray(),
                'comun::msgs.la_model_updated_successfully',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                false,
                500);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/api/v1/venta/motivo_ventas/{id}",
     *      summary="Remove the specified MotivoVenta from storage",
     *      tags={"MotivoVenta"},
     *      description="Delete MotivoVenta",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MotivoVenta",
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
        try{
            /** @var MotivoVenta $motivoVenta */
            $motivoVenta = $this->motivoVentaRepository->find($id);
            $motivoVenta->active=false;
            $result= $this->motivoVentaRepository->update($motivoVenta->toArray(),$motivoVenta->id);

            return $this->sendResponse($result->toArray(),
                'comun::msgs.la_model_desactivated_successfully',
                true,
                200);

        } catch (ModelNotFoundException $e) {
    return $this->sendResponse([],
    'comun::msgs.la_model_not_found',
    false,
    404);
    } catch
    (\Exception $e) {

        return $this->sendResponse([],
            'comun::msgs.msg_error_contact_the_administrator',
            false,
            500);
    }
        }
}
