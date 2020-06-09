<?php

namespace Modules\CondicionCorporal\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\CondicionCorporal\Entities\CondicionCorporal;
use Modules\CondicionCorporal\Http\Requests\CreateCondicionCorporalAPIRequest;
use Modules\CondicionCorporal\Http\Requests\UpdateCondicionCorporalAPIRequest;
use Modules\CondicionCorporal\Repositories\CondicionCorporalRepository;

/**
 * Class CondicionCorporalController
 * @package Modules\CondicionCorporal\Http\Controllers
 */
class CondicionCorporalAPIController extends CommonController
{
    /** @var  CondicionCorporalRepository */
    private $condicionCorporalRepository;

    public function __construct(CondicionCorporalRepository $condicionCorporalRepo)
    {
        $this->condicionCorporalRepository = $condicionCorporalRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/condicion_corporal/condiciones_corporales",
     *      summary="Get a listing of the CondicionCorporals.",
     *      tags={"CondicionCorporal"},
     *      description="Get all CondicionCorporals",
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
     *                  @SWG\Items(ref="#/definitions/CondicionCorporal")
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

            $paginate = isset($request->paginado) ? $request->paginado : null;
            if ($paginate) {
                $condicionCorporals = $this->condicionCorporalRepository->paginate($paginate);
            } else {
                $condicionCorporals = $this->condicionCorporalRepository->all(
                    $request->except(['skip', 'limit']),
                    $request->get('skip'),
                    $request->get('limit')
                );
            }


            return $this->sendResponse($condicionCorporals->toArray(),
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
     * @param CreateCondicionCorporalAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/condicion_corporal/condiciones_corporales",
     *      summary="Store a newly created CondicionCorporal in storage",
     *      tags={"CondicionCorporal"},
     *      description="Store CondicionCorporal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CondicionCorporal that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CondicionCorporal")
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
     *                  ref="#/definitions/CondicionCorporal"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCondicionCorporalAPIRequest $request)
    {
        try {
            $input = $request->all();

            $condicionCorporal = $this->condicionCorporalRepository->create($input);
            return $this->sendResponse($condicionCorporal->toArray(),
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
     * @param int $id
     * @param UpdateCondicionCorporalAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/condicion_corporal/condiciones_corporales/{id}",
     *      summary="Update the specified CondicionCorporal in storage",
     *      tags={"CondicionCorporal"},
     *      description="Update CondicionCorporal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CondicionCorporal",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CondicionCorporal that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CondicionCorporal")
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
     *                  ref="#/definitions/CondicionCorporal"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCondicionCorporalAPIRequest $request)
    {
        try {
            $input = $request->all();

            /** @var CondicionCorporal $condicionCorporal */
            $condicionCorporal = $this->condicionCorporalRepository->find($id);


            $condicionCorporal = $this->condicionCorporalRepository->update($input, $id);

            return $this->sendResponse($condicionCorporal->toArray(),
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
     * @SWG\Delete(
     *      path="/api/v1/condicion_corporal/condiciones_corporales/{id}",
     *      summary="Remove the specified CondicionCorporal from storage",
     *      tags={"CondicionCorporal"},
     *      description="Delete CondicionCorporal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CondicionCorporal",
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
     * @throws \Exception
     */
    public function destroy($id)
    {
        try {
            /** @var CondicionCorporal $condicionCorporal */
            $condicionCorporal = $this->condicionCorporalRepository->find($id);

            if (empty($condicionCorporal)) {
                return $this->sendError('Condicion Corporal not found', 404);
            }

            $condicionCorporal->delete();

            return $this->sendResponse($condicionCorporal->toArray(),
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
}
