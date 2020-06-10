<?php

namespace Modules\Evento\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Evento\Entities\Evento;
use Modules\Evento\Http\Requests\CreateEventoAPIRequest;
use Modules\Evento\Http\Requests\UpdateEventoAPIRequest;
use Modules\Evento\Repositories\EventoRepository;
use Response;

/**
 * Class EventoController
 * @package Modules\Evento\Http\Controllers
 */
class EventoAPIController extends CommonController
{
    /** @var  EventoRepository */
    private $eventoRepository;

    public function __construct(EventoRepository $eventoRepo)
    {
        $this->eventoRepository = $eventoRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/evento/eventos",
     *      summary="Get a listing of the Eventos.",
     *      tags={"Evento"},
     *      description="Get all Eventos",
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
     *                  @SWG\Items(ref="#/definitions/Evento")
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
        $paginate = isset($request->paginado) ? $request->paginado : null;

        if ($paginate) {

            $eventos = $this->eventoRepository->paginate($paginate);
        } else {
            $eventos = $this->eventoRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
        }


        return $this->sendResponse($eventos->toArray(), 'Eventos retrieved successfully');
    }

    /**
     * @param CreateEventoAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/evento/eventos",
     *      summary="Store a newly created Evento in storage",
     *      tags={"Evento"},
     *      description="Store Evento",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Evento that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Evento")
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
     *                  ref="#/definitions/Evento"
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
    public function store(CreateEventoAPIRequest $request)
    {
        $input = $request->all();

        $evento = $this->eventoRepository->create($input);

        return $this->sendResponse($evento->toArray(), 'Evento saved successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/evento/eventos/{id}",
     *      summary="Display the specified Evento",
     *      tags={"Evento"},
     *      description="Get Evento",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Evento",
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
     *                  ref="#/definitions/Evento"
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
        /** @var Evento $evento */
        $evento = $this->eventoRepository->find($id);

        if (empty($evento)) {
            return $this->sendError('Evento not found', 404);
        }

        return $this->sendResponse($evento->toArray(), 'Evento retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateEventoAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/evento/eventos/{id}",
     *      summary="Update the specified Evento in storage",
     *      tags={"Evento"},
     *      description="Update Evento",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Evento",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Evento that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Evento")
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
     *                  ref="#/definitions/Evento"
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
    public function update($id, UpdateEventoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Evento $evento */
        $evento = $this->eventoRepository->find($id);

        if (empty($evento)) {
            return $this->sendError('Evento not found', 404);
        }

        $evento = $this->eventoRepository->update($input, $id);

        return $this->sendResponse($evento->toArray(), 'Evento updated successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/api/v1/evento/eventos/{id}",
     *      summary="Remove the specified Evento from storage",
     *      tags={"Evento"},
     *      description="Delete Evento",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Evento",
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
        /** @var Evento $evento */
        $evento = $this->eventoRepository->find($id);

        if (empty($evento)) {
            return $this->sendError('Evento not found', 404);
        }

        $evento->delete();

        return $this->sendSuccess('Evento deleted successfully');
    }
}
