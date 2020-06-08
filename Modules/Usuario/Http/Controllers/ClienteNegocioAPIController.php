<?php

namespace Modules\Usuario\Http\Controllers;

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
     *          name="body",
     *          in="body",
     *          description="ClienteNegocio that should be stored",
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
     *      )
     * )
     */
    public function index(Request $request)
    {

        $clienteNegocios = null;
        $paginate = isset($request['paginate']) ? $request['paginate'] : null;

        if ($paginate) {
            $clienteNegocios = $this->clienteNegocioRepository->allPaginate($paginate);
        } else {
            $clienteNegocios = $this->clienteNegocioRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
        }


        return $this->sendResponse($clienteNegocios->toArray(), 'Cliente Negocios retrieved successfully');
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
     *      )
     * )
     */
    public function store(CreateClienteNegocioAPIRequest $request)
    {
        $input = $request->all();

        $clienteNegocio = $this->clienteNegocioRepository->create($input);

        return $this->sendResponse($clienteNegocio->toArray(), 'Cliente Negocio saved successfully');
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
     *      )
     * )
     */
    public function show($id)
    {
        /** @var ClienteNegocio $clienteNegocio */
        $clienteNegocio = $this->clienteNegocioRepository->find($id);

        if (empty($clienteNegocio)) {
            return $this->sendError('Cliente Negocio not found');
        }

        return $this->sendResponse($clienteNegocio->toArray(), 'Cliente Negocio retrieved successfully');
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
     *      )
     * )
     */
    public function update($id, UpdateClienteNegocioAPIRequest $request)
    {
        $input = $request->all();

        /** @var ClienteNegocio $clienteNegocio */
        $clienteNegocio = $this->clienteNegocioRepository->find($id);

        if (empty($clienteNegocio)) {
            return $this->sendError('Cliente Negocio not found');
        }

        $clienteNegocio = $this->clienteNegocioRepository->update($input, $id);

        return $this->sendResponse($clienteNegocio->toArray(), 'ClienteNegocio updated successfully');
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
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var ClienteNegocio $clienteNegocio */
        $clienteNegocio = $this->clienteNegocioRepository->find($id);

        if (empty($clienteNegocio)) {
            return $this->sendError('Cliente Negocio not found');
        }

        $clienteNegocio->delete();

        return $this->sendSuccess('Cliente Negocio deleted successfully');
    }
}
