<?php

namespace Modules\Animal\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Animal\Http\Requests\CreateLecheAPIRequest;
use Modules\Animal\Http\Requests\UpdateLecheAPIRequest;
use Modules\Animal\Entities\Leche;
use Modules\Animal\Repositories\LecheRepository;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;


/**
 * Class LecheController
 * @package Modules\Animal\Http\Controllers
 */

class LecheAPIController extends CommonController
{
    /** @var  LecheRepository */
    private $lecheRepository;

    public function __construct(LecheRepository $lecheRepo)
    {
        $this->lecheRepository = $lecheRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/animal/leches",
     *      summary="Get a listing of the Leches.",
     *      tags={"Leche"},
     *      description="Get all Leches",
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
     *                  @SWG\Items(ref="#/definitions/Leche")
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
                $leches = $this->lecheRepository->paginate($paginate);
            } else {

        $leches = $this->lecheRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );
            }


            return $this->sendResponse($leches->toArray(),
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
     * @param CreateLecheAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/animal/leches",
     *      summary="Store a newly created Leche in storage",
     *      tags={"Leche"},
     *      description="Store Leche",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Leche that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Leche")
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
     *                  ref="#/definitions/Leche"
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
    public function store(CreateLecheAPIRequest $request)
    {
        try{
        $input = $request->all();

        $leche = $this->lecheRepository->create($input);

        return $this->sendResponse($leche->toArray(),
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
     * @param UpdateLecheAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/animal/leches/{id}",
     *      summary="Update the specified Leche in storage",
     *      tags={"Leche"},
     *      description="Update Leche",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Leche",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Leche that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Leche")
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
     *                  ref="#/definitions/Leche"
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
    public function update($id, UpdateLecheAPIRequest $request)
    {
        try{

        $input = $request->all();

        /** @var Leche $leche */
        $this->lecheRepository->find($id);
        $leche = $this->lecheRepository->update($input, $id);

            return $this->sendResponse($leche->toArray(),
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
     *      path="/api/v1/animal/leches/{id}",
     *      summary="Remove the specified Leche from storage",
     *      tags={"Leche"},
     *      description="Delete Leche",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Leche",
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
        /** @var Leche $leche */
        $leche = $this->lecheRepository->find($id);
        $leche->active = false;
        $result = $this->lecheRepository->update($leche->toArray(), $leche->id);

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
