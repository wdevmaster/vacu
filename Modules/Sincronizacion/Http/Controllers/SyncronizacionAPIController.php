<?php

namespace Modules\Sincronizacion\Http\Controllers;

use Modules\Sincronizacion\Http\Requests\CreateSyncronizacionAPIRequest;
use Modules\Sincronizacion\Http\Requests\UpdateSyncronizacionAPIRequest;
use Modules\Sincronizacion\Entities\Syncronizacion;
use Modules\Sincronizacion\Repositories\SyncronizacionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SyncronizacionController
 * @package Modules\Sincronizacion\Http\Controllers
 */

class SyncronizacionAPIController extends AppBaseController
{
    /** @var  SyncronizacionRepository */
    private $syncronizacionRepository;

    public function __construct(SyncronizacionRepository $syncronizacionRepo)
    {
        $this->syncronizacionRepository = $syncronizacionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/syncronizacions",
     *      summary="Get a listing of the Syncronizacions.",
     *      tags={"Syncronizacion"},
     *      description="Get all Syncronizacions",
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
     *                  @SWG\Items(ref="#/definitions/Syncronizacion")
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
        $syncronizacions = $this->syncronizacionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($syncronizacions->toArray(), 'Syncronizacions retrieved successfully');
    }

    /**
     * @param CreateSyncronizacionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/syncronizacions",
     *      summary="Store a newly created Syncronizacion in storage",
     *      tags={"Syncronizacion"},
     *      description="Store Syncronizacion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Syncronizacion that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Syncronizacion")
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
     *                  ref="#/definitions/Syncronizacion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSyncronizacionAPIRequest $request)
    {
        $input = $request->all();

        $syncronizacion = $this->syncronizacionRepository->create($input);

        return $this->sendResponse($syncronizacion->toArray(), 'Syncronizacion saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/syncronizacions/{id}",
     *      summary="Display the specified Syncronizacion",
     *      tags={"Syncronizacion"},
     *      description="Get Syncronizacion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Syncronizacion",
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
     *                  ref="#/definitions/Syncronizacion"
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
        /** @var Syncronizacion $syncronizacion */
        $syncronizacion = $this->syncronizacionRepository->find($id);

        if (empty($syncronizacion)) {
            return $this->sendError('Syncronizacion not found');
        }

        return $this->sendResponse($syncronizacion->toArray(), 'Syncronizacion retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSyncronizacionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/syncronizacions/{id}",
     *      summary="Update the specified Syncronizacion in storage",
     *      tags={"Syncronizacion"},
     *      description="Update Syncronizacion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Syncronizacion",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Syncronizacion that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Syncronizacion")
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
     *                  ref="#/definitions/Syncronizacion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSyncronizacionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Syncronizacion $syncronizacion */
        $syncronizacion = $this->syncronizacionRepository->find($id);

        if (empty($syncronizacion)) {
            return $this->sendError('Syncronizacion not found');
        }

        $syncronizacion = $this->syncronizacionRepository->update($input, $id);

        return $this->sendResponse($syncronizacion->toArray(), 'Syncronizacion updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/syncronizacions/{id}",
     *      summary="Remove the specified Syncronizacion from storage",
     *      tags={"Syncronizacion"},
     *      description="Delete Syncronizacion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Syncronizacion",
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
        /** @var Syncronizacion $syncronizacion */
        $syncronizacion = $this->syncronizacionRepository->find($id);

        if (empty($syncronizacion)) {
            return $this->sendError('Syncronizacion not found');
        }

        $syncronizacion->delete();

        return $this->sendSuccess('Syncronizacion deleted successfully');
    }
}
