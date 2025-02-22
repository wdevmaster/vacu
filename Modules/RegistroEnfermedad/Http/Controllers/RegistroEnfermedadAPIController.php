<?php

namespace Modules\RegistroEnfermedad\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\RegistroEnfermedad\Entities\RegistroEnfermedad;
use Modules\RegistroEnfermedad\Http\Requests\CreateRegistroEnfermedadAPIRequest;
use Modules\RegistroEnfermedad\Http\Requests\UpdateRegistroEnfermedadAPIRequest;
use Modules\RegistroEnfermedad\Repositories\RegistroEnfermedadRepository;


/**
 * Class RegistroEnfermedadController
 * @package Modules\RegistroEnfermedad\Http\Controllers
 */
class RegistroEnfermedadAPIController extends CommonController
{
    /** @var  RegistroEnfermedadRepository */
    private $registroEnfermedadRepository;

    public function __construct(RegistroEnfermedadRepository $registroEnfermedadRepo)
    {
        $this->registroEnfermedadRepository = $registroEnfermedadRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/registro_enfermedad/registros_enfermedades",
     *      summary="Get a listing of the RegistroEnfermedads.",
     *      tags={"RegistroEnfermedad"},
     *      description="Get all RegistroEnfermedads",
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
     *                  @SWG\Items(ref="#/definitions/RegistroEnfermedad")
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
            $registroEnfermedads = $this->registroEnfermedadRepository->paginate($paginate);
        } else {
            $registroEnfermedads = $this->registroEnfermedadRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
        }

            return $this->sendResponse($registroEnfermedads->toArray(),
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
     * @param CreateRegistroEnfermedadAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/registro_enfermedad/registros_enfermedades",
     *      summary="Store a newly created RegistroEnfermedad in storage",
     *      tags={"RegistroEnfermedad"},
     *      description="Store RegistroEnfermedad",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RegistroEnfermedad that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RegistroEnfermedad")
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
     *                  ref="#/definitions/RegistroEnfermedad"
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
    public function store(CreateRegistroEnfermedadAPIRequest $request)
    {
        try{
        $input = $request->all();

        $registroEnfermedad = $this->registroEnfermedadRepository->create($input);

            return $this->sendResponse($registroEnfermedad->toArray(),
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
     *      path="/api/v1/registro_enfermedad/registros_enfermedades/{id}",
     *      summary="Display the specified RegistroEnfermedad",
     *      tags={"RegistroEnfermedad"},
     *      description="Get RegistroEnfermedad",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RegistroEnfermedad",
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
     *                  ref="#/definitions/RegistroEnfermedad"
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
        /** @var RegistroEnfermedad $registroEnfermedad */
        $registroEnfermedad = $this->registroEnfermedadRepository->find($id);


            return $this->sendResponse($registroEnfermedad->toArray(),
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
     * @param UpdateRegistroEnfermedadAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/registro_enfermedad/registros_enfermedades/{id}",
     *      summary="Update the specified RegistroEnfermedad in storage",
     *      tags={"RegistroEnfermedad"},
     *      description="Update RegistroEnfermedad",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RegistroEnfermedad",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RegistroEnfermedad that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RegistroEnfermedad")
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
     *                  ref="#/definitions/RegistroEnfermedad"
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
    public function update($id, UpdateRegistroEnfermedadAPIRequest $request)
    {
        try{
        $input = $request->all();

        /** @var RegistroEnfermedad $registroEnfermedad */
         $this->registroEnfermedadRepository->find($id);

        $registroEnfermedad = $this->registroEnfermedadRepository->update($input, $id);

            return $this->sendResponse($registroEnfermedad->toArray(),
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
     *      path="/api/v1/registro_enfermedad/registros_enfermedades/{id}",
     *      summary="Remove the specified RegistroEnfermedad from storage",
     *      tags={"RegistroEnfermedad"},
     *      description="Delete RegistroEnfermedad",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RegistroEnfermedad",
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
        /** @var RegistroEnfermedad $registroEnfermedad */
        $registroEnfermedad = $this->registroEnfermedadRepository->find($id);
        $registroEnfermedad->active=false;
        $result= $this->registroEnfermedadRepository->update($registroEnfermedad->toArray(),$registroEnfermedad->id);

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
