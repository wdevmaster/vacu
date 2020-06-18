<?php

namespace Modules\Inseminador\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Inseminador\Entities\Inseminador;
use Modules\Inseminador\Http\Requests\CreateInseminadorAPIRequest;
use Modules\Inseminador\Http\Requests\UpdateInseminadorAPIRequest;
use Modules\Inseminador\Repositories\InseminadorRepository;


/**
 * Class InseminadorController
 * @package Modules\Inseminador\Http\Controllers
 */
class InseminadorAPIController extends CommonController
{
    /** @var  InseminadorRepository */
    private $inseminadorRepository;

    public function __construct(InseminadorRepository $inseminadorRepo)
    {
        $this->inseminadorRepository = $inseminadorRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/inseminador/inseminadores",
     *      summary="Get a listing of the Inseminadors.",
     *      tags={"Inseminador"},
     *      description="Get all Inseminadors",
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
     *                  @SWG\Items(ref="#/definitions/Inseminador")
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
            $inseminadors = $this->inseminadorRepository->paginate($paginate);
        } else {
            $inseminadors = $this->inseminadorRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
        }

            return $this->sendResponse($inseminadors->toArray(),
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
     * @param CreateInseminadorAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/inseminador/inseminadores",
     *      summary="Store a newly created Inseminador in storage",
     *      tags={"Inseminador"},
     *      description="Store Inseminador",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Inseminador that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Inseminador")
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
     *                  ref="#/definitions/Inseminador"
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
    public function store(CreateInseminadorAPIRequest $request)
    {
        try{
        $input = $request->all();

        $inseminador = $this->inseminadorRepository->create($input);


            return $this->sendResponse($inseminador->toArray(),
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
     *      path="/api/v1/inseminador/inseminadores/{id}",
     *      summary="Display the specified Inseminador",
     *      tags={"Inseminador"},
     *      description="Get Inseminador",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Inseminador",
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
     *                  ref="#/definitions/Inseminador"
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
        /** @var Inseminador $inseminador */
        $inseminador = $this->inseminadorRepository->find($id);


            return $this->sendResponse($inseminador->toArray(),
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
     * @param UpdateInseminadorAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/inseminador/inseminadores/{id}",
     *      summary="Update the specified Inseminador in storage",
     *      tags={"Inseminador"},
     *      description="Update Inseminador",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Inseminador",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Inseminador that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Inseminador")
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
     *                  ref="#/definitions/Inseminador"
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
    public function update($id, UpdateInseminadorAPIRequest $request)
    {
        try{
        $input = $request->all();

        /** @var Inseminador $inseminador */
        $this->inseminadorRepository->find($id);

         $inseminador = $this->inseminadorRepository->update($input, $id);


            return $this->sendResponse($inseminador->toArray(),
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
     *      path="/api/v1/inseminador/inseminadores/{id}",
     *      summary="Remove the specified Inseminador from storage",
     *      tags={"Inseminador"},
     *      description="Delete Inseminador",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Inseminador",
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
        /** @var Inseminador $inseminador */
        $inseminador = $this->inseminadorRepository->find($id);

       $inseminador->active=false;
       $result= $this->inseminadorRepository->update($inseminador->toArray(),$inseminador->id);

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
