<?php

namespace Modules\EstadoFisico\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\EstadoFisico\Entities\EstadoFisico;
use Modules\EstadoFisico\Http\Requests\CreateEstadoFisicoAPIRequest;
use Modules\EstadoFisico\Http\Requests\UpdateEstadoFisicoAPIRequest;
use Modules\EstadoFisico\Repositories\EstadoFisicoRepository;

/**
 * Class EstadoFisicoController
 * @package Modules\EstadoFisico\Http\Controllers
 */
class EstadoFisicoAPIController extends CommonController
{
    /** @var  EstadoFisicoRepository */
    private $estadoFisicoRepository;

    public function __construct(EstadoFisicoRepository $estadoFisicoRepo)
    {
        $this->estadoFisicoRepository = $estadoFisicoRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/estado_fisico/estados_fisicos",
     *      summary="Get a listing of the EstadoFisicos.",
     *      tags={"EstadoFisico"},
     *      description="Get all EstadoFisicos",
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
     *                  @SWG\Items(ref="#/definitions/EstadoFisico")
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
                $estadoFisicos = $this->estadoFisicoRepository->paginate($paginate);
            } else {
                $estadoFisicos = $this->estadoFisicoRepository->all(
                    $request->except(['skip', 'limit']),
                    $request->get('skip'),
                    $request->get('limit')
                );
            }

          return $this->sendResponse($estadoFisicos->toArray(),
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
     * @param CreateEstadoFisicoAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/estado_fisico/estados_fisicos",
     *      summary="Store a newly created EstadoFisico in storage",
     *      tags={"EstadoFisico"},
     *      description="Store EstadoFisico",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="EstadoFisico that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/EstadoFisico")
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
     *                  ref="#/definitions/EstadoFisico"
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
    public function store(CreateEstadoFisicoAPIRequest $request)
    {
        try {
            $input = $request->all();

            $estadoFisico = $this->estadoFisicoRepository->create($input);


            return $this->sendResponse($estadoFisico->toArray(),
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
     *      path="/api/v1/estado_fisico/estados_fisicos/{id}",
     *      summary="Display the specified EstadoFisico",
     *      tags={"EstadoFisico"},
     *      description="Get EstadoFisico",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EstadoFisico",
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
     *                  ref="#/definitions/EstadoFisico"
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
        /** @var EstadoFisico $estadoFisico */
        $estadoFisico = $this->estadoFisicoRepository->find($id);



           return $this->sendResponse($estadoFisico->toArray(),
               'comun::msgs.la_model_find_successfully',
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
     * @param UpdateEstadoFisicoAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/estado_fisico/estados_fisicos/{id}",
     *      summary="Update the specified EstadoFisico in storage",
     *      tags={"EstadoFisico"},
     *      description="Update EstadoFisico",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EstadoFisico",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="EstadoFisico that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/EstadoFisico")
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
     *                  ref="#/definitions/EstadoFisico"
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
    public function update($id, UpdateEstadoFisicoAPIRequest $request)
    {
        try{
        $input = $request->all();

        /** @var EstadoFisico $estadoFisico */
        $this->estadoFisicoRepository->find($id);

        $estadoFisico = $this->estadoFisicoRepository->update($input, $id);

            return $this->sendResponse($estadoFisico->toArray(),
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
     *      path="/api/v1/estado_fisico/estados_fisicos/{id}",
     *      summary="Remove the specified EstadoFisico from storage",
     *      tags={"EstadoFisico"},
     *      description="Delete EstadoFisico",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EstadoFisico",
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
        /** @var EstadoFisico $estadoFisico */
        $estadoFisico = $this->estadoFisicoRepository->find($id);

        $estadoFisico->active=false;
        $result= $this->estadoFisicoRepository->update($estadoFisico->toArray(),$estadoFisico->id);

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
