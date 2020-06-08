<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Cliente\Entities\Cliente;
use Modules\Cliente\Http\Requests\CreateClienteAPIRequest;
use Modules\Cliente\Http\Requests\UpdateClienteAPIRequest;
use Modules\Cliente\Repositories\ClienteRepository;
use Modules\Common\Http\Controllers\CommonController;

/**
 * Class ClienteController
 * @package Modules\Cliente\Http\Controllers
 */
class ClienteAPIController extends CommonController
{
    /** @var  ClienteRepository */
    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepo)
    {
        $this->clienteRepository = $clienteRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/cliente/clientes",
     *      summary="Get a listing of the Clientes.",
     *      tags={"Cliente"},
     *      description="Get all Clientes",
     *      produces={"application/json"},
     *     @SWG\Parameter(
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
     *                  @SWG\Items(ref="#/definitions/Cliente")
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

            $paginate = isset($request['paginate']) ? $request['paginate'] : null;

            if ($paginate) {
                $clientes = $this->clienteRepository->paginate($paginate);
            } else {
                $clientes = $this->clienteRepository->all(
                    $request->except(['skip', 'limit']),
                    $request->get('skip'),
                    $request->get('limit')
                );
            }

            return $this->sendResponse($clientes->toArray(),
                'comun::msgs.la_model_list_successfully',
                'cliente::msgs.label_cliente',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                'cliente::msgs.label_cliente',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                'cliente::msgs.label_cliente',
                false,
                500);
        }
    }

    /**
     * @param CreateClienteAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/cliente/clientes",
     *      summary="Store a newly created Cliente in storage",
     *      tags={"Cliente"},
     *      description="Store Cliente",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Cliente that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Cliente")
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
     *                  ref="#/definitions/Cliente"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateClienteAPIRequest $request)
    {
        try {
            $input = $request->all();

            $cliente = $this->clienteRepository->create($input);

            return $this->sendResponse($cliente->toArray(),
                'comun::msgs.la_model_created_successfully',
                'cliente::msgs.label_cliente',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                'cliente::msgs.label_cliente',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                'cliente::msgs.label_cliente',
                false,
                500);
        }
    }


    /**
     * @param int $id
     * @param UpdateClienteAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/cliente/clientes/{id}",
     *      summary="Update the specified Cliente in storage",
     *      tags={"Cliente"},
     *      description="Update Cliente",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Cliente",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Cliente that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Cliente")
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
     *                  ref="#/definitions/Cliente"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateClienteAPIRequest $request)
    {
        try {
            $input = $request->all();

            /** @var Cliente $cliente */
            $cliente = $this->clienteRepository->find($id);


            $cliente = $this->clienteRepository->update($input, $id);

            return $this->sendResponse($cliente->toArray(),
                'comun::msgs.la_model_updated_successfully',
                'cliente::msgs.label_cliente',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                'cliente::msgs.label_cliente',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                'cliente::msgs.label_cliente',
                false,
                500);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Delete(
     *      path="/api/v1/cliente/clientes/{id}",
     *      summary="Remove the specified Cliente from storage",
     *      tags={"Cliente"},
     *      description="Delete Cliente",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Cliente",
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
            /** @var Cliente $cliente */
            $cliente = $this->clienteRepository->find($id);


            $cliente->delete();

            return $this->sendResponse($cliente->toArray(),
                'comun::msgs.la_model_desactivated_successfully',
                'cliente::msgs.label_cliente',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                'cliente::msgs.label_cliente',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                'cliente::msgs.label_cliente',
                false,
                500);
        }
    }
}
