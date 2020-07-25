<?php

namespace Modules\Animal\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Animal\Http\Requests\CreatePalpacionAPIRequest;
use Modules\Animal\Http\Requests\UpdatePalpacionAPIRequest;
use Modules\Animal\Entities\Palpacion;
use Modules\Animal\Repositories\PalpacionRepository;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;


/**
 * Class PalpacionController
 * @package Modules\Animal\Http\Controllers
 */

class PalpacionAPIController extends CommonController
{
    /** @var  PalpacionRepository */
    private $palpacionRepository;

    public function __construct(PalpacionRepository $palpacionRepo)
    {
        $this->palpacionRepository = $palpacionRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/animal/palpaciones",
     *      summary="Get a listing of the Palpacions.",
     *      tags={"Palpacion"},
     *      description="Get all Palpacions",
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
     *                  @SWG\Items(ref="#/definitions/Palpacion")
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
        try {

            $paginate = isset($request->paginado) ? $request->paginado : null;

            if ($paginate) {
                $palpacions = $this->palpacionRepository->paginate($paginate);
            } else {

            $palpacions = $this->palpacionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );
            }


            return $this->sendResponse($palpacions->toArray(),
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
     * @param CreatePalpacionAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/animal/palpaciones",
     *      summary="Store a newly created Palpacion in storage",
     *      tags={"Palpacion"},
     *      description="Store Palpacion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Palpacion that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Palpacion")
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
     *                  ref="#/definitions/Palpacion"
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
    public function store(CreatePalpacionAPIRequest $request)
    {
        try{
        $input = $request->all();

        $palpacion = $this->palpacionRepository->create($input);

        return $this->sendResponse($palpacion->toArray(),
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
     * @param UpdatePalpacionAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/animal/palpaciones/{id}",
     *      summary="Update the specified Palpacion in storage",
     *      tags={"Palpacion"},
     *      description="Update Palpacion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Palpacion",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Palpacion that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Palpacion")
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
     *                  ref="#/definitions/Palpacion"
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
    public function update($id, UpdatePalpacionAPIRequest $request)
    {
        try{

        $input = $request->all();

        /** @var Palpacion $palpacion */
        $this->palpacionRepository->find($id);

        $palpacion = $this->palpacionRepository->update($input, $id);

            return $this->sendResponse($palpacion->toArray(),
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
     *      path="/api/v1/animal/palpaciones/{id}",
     *      summary="Remove the specified Palpacion from storage",
     *      tags={"Palpacion"},
     *      description="Delete Palpacion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Palpacion",
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
        /** @var Palpacion $palpacion */
        $palpacion = $this->palpacionRepository->find($id);
        $palpacion->active = false;
        $result = $this->palpacionRepository->update($palpacion->toArray(), $palpacion->id);


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
