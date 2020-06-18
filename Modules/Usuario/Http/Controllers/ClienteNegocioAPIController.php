<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Usuario\Entities\ClienteNegocio;
use Modules\Usuario\Http\Requests\CreateClienteNegocioAPIRequest;
use Modules\Usuario\Http\Requests\UpdateClienteNegocioAPIRequest;
use Modules\Usuario\Repositories\ClienteNegocioRepository;

/**
 * Class ClienteNegocioController
 * @package Modules\Usuario\Http\Controllers
 */
class ClienteNegocioAPIController extends CommonController
{
    /** @var  ClienteNegocioRepository */
    private $clienteNegocioRepository;

    public function __construct(ClienteNegocioRepository $clienteNegocioRepo)
    {
        $this->clienteNegocioRepository = $clienteNegocioRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/usuario/clientes_negocios",
     *      summary="Get a listing of the ClienteNegocios.",
     *      tags={"User"},
     *      description="Get all ClienteNegocios",
     *      produces={"application/json"},
     *      @SWG\Parameter(
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
     *                  @SWG\Items(ref="#/definitions/ClienteNegocio")
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

        $clienteNegocios = null;
        $paginate = isset($request->paginado) ? $request->paginado: null;

        if ($paginate) {
            $clienteNegocios = $this->clienteNegocioRepository->paginate($paginate);
        } else {
            $clienteNegocios = $this->clienteNegocioRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
        }

            return $this->sendResponse($clienteNegocios->toArray(),
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
     * @param CreateClienteNegocioAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/usuario/clientes_negocios",
     *      summary="Store a newly created ClienteNegocio in storage",
     *      tags={"User"},
     *      description="Store ClienteNegocio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ClienteNegocio that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ClienteNegocio")
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
     *                  ref="#/definitions/ClienteNegocio"
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
    public function store(CreateClienteNegocioAPIRequest $request)
    {
        try{
        $input = $request->all();

        $clienteNegocio = $this->clienteNegocioRepository->create($input);

            return $this->sendResponse($clienteNegocio->toArray(),
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
     *      path="/api/v1/usuario/clientes_negocios/{id}",
     *      summary="Display the specified ClienteNegocio",
     *      tags={"User"},
     *      description="Get ClienteNegocio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ClienteNegocio",
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
     *                  ref="#/definitions/ClienteNegocio"
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
        /** @var ClienteNegocio $clienteNegocio */
        $clienteNegocio = $this->clienteNegocioRepository->find($id);

            return $this->sendResponse($clienteNegocio->toArray(),
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
     * @param UpdateClienteNegocioAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/usuario/clientes_negocios/{id}",
     *      summary="Update the specified ClienteNegocio in storage",
     *      tags={"User"},
     *      description="Update ClienteNegocio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ClienteNegocio",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ClienteNegocio that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ClienteNegocio")
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
     *                  ref="#/definitions/ClienteNegocio"
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
    public function update($id, UpdateClienteNegocioAPIRequest $request)
    {
        try{
        $input = $request->all();

        /** @var ClienteNegocio $clienteNegocio */
         $this->clienteNegocioRepository->find($id);

        $clienteNegocio = $this->clienteNegocioRepository->update($input, $id);

            return $this->sendResponse($clienteNegocio->toArray(),
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
     *      path="/api/v1/usuario/clientes_negocios/{id}",
     *      summary="Remove the specified ClienteNegocio from storage",
     *      tags={"User"},
     *      description="Delete ClienteNegocio",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ClienteNegocio",
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
        /** @var ClienteNegocio $clienteNegocio */
        $clienteNegocio = $this->clienteNegocioRepository->find($id);
        $clienteNegocio->active=false;
        $result= $this->clienteNegocioRepository->update($clienteNegocio->toArray(),$clienteNegocio->id);
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
