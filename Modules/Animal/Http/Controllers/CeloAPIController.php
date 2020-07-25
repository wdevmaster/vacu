<?php

namespace Modules\Animal\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Animal\Http\Requests\CreateCeloAPIRequest;
use Modules\Animal\Http\Requests\UpdateCeloAPIRequest;
use Modules\Animal\Entities\Celo;
use Modules\Animal\Repositories\CeloRepository;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;


/**
 * Class CeloController
 * @package Modules\Animal\Http\Controllers
 */

class CeloAPIController extends CommonController
{
    /** @var  CeloRepository */
    private $celoRepository;

    public function __construct(CeloRepository $celoRepo)
    {
        $this->celoRepository = $celoRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/animal/celos",
     *      summary="Get a listing of the Celos.",
     *      tags={"Celo"},
     *      description="Get all Celos",
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
     *                  @SWG\Items(ref="#/definitions/Celo")
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
                $celos = $this->celoRepository->paginate($paginate);
            } else {

        $celos = $this->celoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );
            }


            return $this->sendResponse($celos->toArray(),
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
     * @param CreateCeloAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/animal/celos",
     *      summary="Store a newly created Celo in storage",
     *      tags={"Celo"},
     *      description="Store Celo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Celo that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Celo")
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
     *                  ref="#/definitions/Celo"
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
    public function store(CreateCeloAPIRequest $request)
    {
        try{
        $input = $request->all();

        $celo = $this->celoRepository->create($input);

        return $this->sendResponse($celo->toArray(),
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
     * @param UpdateCeloAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/animal/celos/{id}",
     *      summary="Update the specified Celo in storage",
     *      tags={"Celo"},
     *      description="Update Celo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Celo",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Celo that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Celo")
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
     *                  ref="#/definitions/Celo"
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
    public function update($id, UpdateCeloAPIRequest $request)
    {
        try{
        $input = $request->all();

        /** @var Celo $celo */
        $this->celoRepository->find($id);

        $celo = $this->celoRepository->update($input, $id);

        return $this->sendResponse($celo->toArray(),
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
     *      path="/api/v1/animal/celos/{id}",
     *      summary="Remove the specified Celo from storage",
     *      tags={"Celo"},
     *      description="Delete Celo",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Celo",
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
        /** @var Celo $celo */
        $celo = $this->celoRepository->find($id);

        $celo->active = false;
        $result = $this->celoRepository->update($celo->toArray(), $celo->id);


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
