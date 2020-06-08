<?php

namespace Modules\Enfermedad\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Enfermedad\Entities\Enfermedad;
use Modules\Enfermedad\Http\Requests\CreateEnfermedadAPIRequest;
use Modules\Enfermedad\Http\Requests\UpdateEnfermedadAPIRequest;
use Modules\Enfermedad\Repositories\EnfermedadRepository;

/**
 * Class EnfermedadController
 * @package Modules\Enfermedad\Http\Controllers
 */
class EnfermedadAPIController extends CommonController
{
    /** @var  EnfermedadRepository */
    private $enfermedadRepository;

    public function __construct(EnfermedadRepository $enfermedadRepo)
    {
        $this->enfermedadRepository = $enfermedadRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/enfermedad/enfermedades",
     *      summary="Get a listing of the Enfermedads.",
     *      tags={"Enfermedad"},
     *      description="Get all Enfermedads",
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
     *                  @SWG\Items(ref="#/definitions/Enfermedad")
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
                $enfermedads = $this->enfermedadRepository->paginate($paginate);
            } else {
                $enfermedads = $this->enfermedadRepository->all(
                    $request->except(['skip', 'limit']),
                    $request->get('skip'),
                    $request->get('limit')
                );
            }


            return $this->sendResponse($enfermedads->toArray(),
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
     * @param CreateEnfermedadAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/enfermedad/enfermedades",
     *      summary="Store a newly created Enfermedad in storage",
     *      tags={"Enfermedad"},
     *      description="Store Enfermedad",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Enfermedad that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Enfermedad")
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
     *                  ref="#/definitions/Enfermedad"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEnfermedadAPIRequest $request)
    {
        try {
            $input = $request->all();

            $enfermedad = $this->enfermedadRepository->create($input);


            return $this->sendResponse($enfermedad->toArray(),
                'comun::msgs.la_model_created_successfully',
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
     * @param UpdateEnfermedadAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/enfermedades/{id}",
     *      summary="Update the specified Enfermedad in storage",
     *      tags={"Enfermedad"},
     *      description="Update Enfermedad",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Enfermedad",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Enfermedad that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Enfermedad")
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
     *                  ref="#/definitions/Enfermedad"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEnfermedadAPIRequest $request)
    {
        try {
            $input = $request->all();

            /** @var Enfermedad $enfermedad */
            $enfermedad = $this->enfermedadRepository->find($id);


            $enfermedad = $this->enfermedadRepository->update($input, $id);


            return $this->sendResponse($enfermedad->toArray(),
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
     *      path="/api/v1/enfermedad/enfermedades/{id}",
     *      summary="Remove the specified Enfermedad from storage",
     *      tags={"Enfermedad"},
     *      description="Delete Enfermedad",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Enfermedad",
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
        try {
            /** @var Enfermedad $enfermedad */
            $enfermedad = $this->enfermedadRepository->delete($id);

            return $this->sendResponse($enfermedad->toArray(),
                'comun::msgs.la_model_disabled_successfully',
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
