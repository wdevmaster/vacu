<?php

namespace Modules\Negocio\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Negocio\Entities\Negocio;
use Modules\Negocio\Http\Requests\CreateNegocioAPIRequest;
use Modules\Negocio\Http\Requests\UpdateNegocioAPIRequest;
use Modules\Negocio\Repositories\NegocioRepository;

/**
 * Class NegocioController
 * @package Modules\Negocio\Http\Controllers
 */
class NegocioAPIController extends CommonController
{
    /** @var  NegocioRepository */
    private $negocioRepository;

    public function __construct(NegocioRepository $negocioRepo)
    {
        $this->negocioRepository = $negocioRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/negocio/negocios",
     *      summary="Get a listing of the Negocios.",
     *      tags={"Negocio"},
     *      description="Get all Negocios",
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
     *                  @SWG\Items(ref="#/definitions/Negocio")
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
        try {

            $negocios = $this->negocioRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );

            return $this->sendResponse($negocios->toArray(),
                'comun::msgs.la_model_list_successfully',
                'animal::msgs.label_animal',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                'animal::msgs.label_negocio',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                'animal::msgs.label_negocio',
                false,
                500);
        }
    }

    /**
     * @param CreateNegocioAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/negocio/negocios",
     *      summary="Store a newly created Negocio in storage",
     *      tags={"Negocio"},
     *      description="Store Negocio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Negocio that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Negocio")
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
     *                  ref="#/definitions/Negocio"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateNegocioAPIRequest $request)
    {

        try{
        $input = $request->all();

        $negocio = $this->negocioRepository->create($input);

            return $this->sendResponse($negocio->toArray(),
                'comun::msgs.la_model_saved_successfully',
                'animal::msgs.label_negocio',
                true,
                201);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                'animal::msgs.label_negocio',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                'animal::msgs.negocio',
                false,
                500);
        }
    }


    /**
     * @param int $id
     * @param UpdateNegocioAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/negocio/negocios/{id}",
     *      summary="Update the specified Negocio in storage",
     *      tags={"Negocio"},
     *      description="Update Negocio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Negocio",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Negocio that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Negocio")
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
     *                  ref="#/definitions/Negocio"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateNegocioAPIRequest $request)
    {
        try{
        $input = $request->all();

        $negocio = $this->negocioRepository->update($input, $id);

            return $this->sendResponse($negocio->toArray(),
                'comun::msgs.la_model_updated_successfully',
                'animal::msgs.label_negocio',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                'animal::msgs.label_negocio',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                'animal::msgs.label_negocio',
                false,
                500);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Delete(
     *      path="/api/v1/negocio/negocios/{id}",
     *      summary="Remove the specified Negocio from storage",
     *      tags={"Negocio"},
     *      description="Delete Negocio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Negocio",
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
        try{
            /** @var Negocio $negocio */
            $negocio = $this->negocioRepository->find($id);

            $negocio->active = false;
            $result = $this->negocioRepository->update($negocio->toArray(), $id);

            return $this->sendResponse($result->toArray(),
                'comun::msgs.la_model_desactivated_successfully',
                'animal::msgs.label_negocio',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                'animal::msgs.label_negocio',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                'animal::msgs.negocio',
                false,
                500);
        }
    }
}
