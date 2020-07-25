<?php

namespace Modules\Animal\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Animal\Http\Requests\CreateTratamientoAPIRequest;
use Modules\Animal\Http\Requests\UpdateTratamientoAPIRequest;
use Modules\Animal\Entities\Tratamiento;
use Modules\Animal\Repositories\TratamientoRepository;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;


/**
 * Class TratamientoController
 * @package Modules\Animal\Http\Controllers
 */

class TratamientoAPIController extends CommonController
{
    /** @var  TratamientoRepository */
    private $tratamientoRepository;

    public function __construct(TratamientoRepository $tratamientoRepo)
    {
        $this->tratamientoRepository = $tratamientoRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/animal/tratamientos",
     *      summary="Get a listing of the Tratamientos.",
     *      tags={"Tratamiento"},
     *      description="Get all Tratamientos",
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
     *                  @SWG\Items(ref="#/definitions/Tratamiento")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *     security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function index(Request $request)
    {
        try {

            $paginate = isset($request->paginado) ? $request->paginado : null;

            if ($paginate) {
                $tratamientos = $this->tratamientoRepository->paginate($paginate);
            } else {

        $tratamientos = $this->tratamientoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );
            }


            return $this->sendResponse($tratamientos->toArray(),
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
     * @param CreateTratamientoAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/animal/tratamientos",
     *      summary="Store a newly created Tratamiento in storage",
     *      tags={"Tratamiento"},
     *      description="Store Tratamiento",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Tratamiento that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Tratamiento")
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
     *                  ref="#/definitions/Tratamiento"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *     security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function store(CreateTratamientoAPIRequest $request)
    {
        try{
        $input = $request->all();

        $tratamiento = $this->tratamientoRepository->create($input);

            return $this->sendResponse($tratamiento->toArray(),
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
     * @param UpdateTratamientoAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/animal/tratamientos/{id}",
     *      summary="Update the specified Tratamiento in storage",
     *      tags={"Tratamiento"},
     *      description="Update Tratamiento",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Tratamiento",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Tratamiento that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Tratamiento")
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
     *                  ref="#/definitions/Tratamiento"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *     security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function update($id, UpdateTratamientoAPIRequest $request)
    {
        try{

        $input = $request->all();

        /** @var Tratamiento $tratamiento */
        $this->tratamientoRepository->find($id);

        $tratamiento = $this->tratamientoRepository->update($input, $id);

            return $this->sendResponse($tratamiento->toArray(),
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
     *      path="/api/v1/animal/tratamientos/{id}",
     *      summary="Remove the specified Tratamiento from storage",
     *      tags={"Tratamiento"},
     *      description="Delete Tratamiento",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Tratamiento",
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
     *     security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function destroy($id)
    {
        try{
        /** @var Tratamiento $tratamiento */
        $tratamiento = $this->tratamientoRepository->find($id);
        $tratamiento->active = false;
        $result = $this->tratamientoRepository->update($tratamiento->toArray(), $tratamiento->id);


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
