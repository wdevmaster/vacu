<?php

namespace Modules\Ingreso\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Ingreso\Entities\Ingreso;
use Modules\Ingreso\Http\Requests\CreateIngresoAPIRequest;
use Modules\Ingreso\Http\Requests\UpdateIngresoAPIRequest;
use Modules\Ingreso\Repositories\IngresoRepository;

/**
 * Class IngresoController
 * @package Modules\Ingreso\Http\Controllers
 */
class IngresoAPIController extends CommonController
{
    /** @var  IngresoRepository */
    private $ingresoRepository;

    public function __construct(IngresoRepository $ingresoRepo)
    {
        $this->ingresoRepository = $ingresoRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/ingreso/ingresos",
     *      summary="Get a listing of the Ingresos.",
     *      tags={"Ingreso"},
     *      description="Get all Ingresos",
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
     *                  @SWG\Items(ref="#/definitions/Ingreso")
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
            $ingresos = $this->ingresoRepository->paginate($paginate);
        } else {
            $ingresos = $this->ingresoRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
        }


            return $this->sendResponse($ingresos->toArray(),
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
     * @param CreateIngresoAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/ingreso/ingresos",
     *      summary="Store a newly created Ingreso in storage",
     *      tags={"Ingreso"},
     *      description="Store Ingreso",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Ingreso that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Ingreso")
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
     *                  ref="#/definitions/Ingreso"
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
    public function store(CreateIngresoAPIRequest $request)
    {
        try{
        $input = $request->all();

        $ingreso = $this->ingresoRepository->create($input);

            return $this->sendResponse($ingreso->toArray(),
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
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/ingreso/ingresos/{id}",
     *      summary="Display the specified Ingreso",
     *      tags={"Ingreso"},
     *      description="Get Ingreso",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Ingreso",
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
     *                  ref="#/definitions/Ingreso"
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
        try{
        /** @var Ingreso $ingreso */
        $ingreso = $this->ingresoRepository->find($id);


            return $this->sendResponse($ingreso->toArray(),
                'comun::msgs.la_model_retrieved_successfully',
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
     * @param UpdateIngresoAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/ingreso/ingresos/{id}",
     *      summary="Update the specified Ingreso in storage",
     *      tags={"Ingreso"},
     *      description="Update Ingreso",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Ingreso",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Ingreso that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Ingreso")
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
     *                  ref="#/definitions/Ingreso"
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
    public function update($id, UpdateIngresoAPIRequest $request)
    {
      try{
        $input = $request->all();

        /** @var Ingreso $ingreso */
         $this->ingresoRepository->find($id);

        $ingreso = $this->ingresoRepository->update($input, $id);


          return $this->sendResponse($ingreso->toArray(),
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
     *      path="/api/v1/ingreso/ingresos/{id}",
     *      summary="Remove the specified Ingreso from storage",
     *      tags={"Ingreso"},
     *      description="Delete Ingreso",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Ingreso",
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
        /** @var Ingreso $ingreso */
        $ingreso = $this->ingresoRepository->find($id);

      $ingreso->active=false;
      $result= $this->ingresoRepository->update($ingreso->toArray(),$ingreso->id);

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
