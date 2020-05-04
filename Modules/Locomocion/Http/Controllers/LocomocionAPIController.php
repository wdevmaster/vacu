<?php

namespace Modules\Locomocion\Http\Controllers;

use Modules\Locomocion\Http\Requests\CreateLocomocionAPIRequest;
use Modules\Locomocion\Http\Requests\UpdateLocomocionAPIRequest;
use Modules\Locomocion\Entities\Locomocion;
use Modules\Locomocion\Repositories\LocomocionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class LocomocionController
 * @package Modules\Locomocion\Http\Controllers
 */

class LocomocionAPIController extends AppBaseController
{
    /** @var  LocomocionRepository */
    private $locomocionRepository;

    public function __construct(LocomocionRepository $locomocionRepo)
    {
        $this->locomocionRepository = $locomocionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/locomocions",
     *      summary="Get a listing of the Locomocions.",
     *      tags={"Locomocion"},
     *      description="Get all Locomocions",
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
     *                  @SWG\Items(ref="#/definitions/Locomocion")
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
        $locomocions = $this->locomocionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($locomocions->toArray(), 'Locomocions retrieved successfully');
    }

    /**
     * @param CreateLocomocionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/locomocions",
     *      summary="Store a newly created Locomocion in storage",
     *      tags={"Locomocion"},
     *      description="Store Locomocion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Locomocion that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Locomocion")
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
     *                  ref="#/definitions/Locomocion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLocomocionAPIRequest $request)
    {
        $input = $request->all();

        $locomocion = $this->locomocionRepository->create($input);

        return $this->sendResponse($locomocion->toArray(), 'Locomocion saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/locomocions/{id}",
     *      summary="Display the specified Locomocion",
     *      tags={"Locomocion"},
     *      description="Get Locomocion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Locomocion",
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
     *                  ref="#/definitions/Locomocion"
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
        /** @var Locomocion $locomocion */
        $locomocion = $this->locomocionRepository->find($id);

        if (empty($locomocion)) {
            return $this->sendError('Locomocion not found');
        }

        return $this->sendResponse($locomocion->toArray(), 'Locomocion retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLocomocionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/locomocions/{id}",
     *      summary="Update the specified Locomocion in storage",
     *      tags={"Locomocion"},
     *      description="Update Locomocion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Locomocion",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Locomocion that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Locomocion")
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
     *                  ref="#/definitions/Locomocion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLocomocionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Locomocion $locomocion */
        $locomocion = $this->locomocionRepository->find($id);

        if (empty($locomocion)) {
            return $this->sendError('Locomocion not found');
        }

        $locomocion = $this->locomocionRepository->update($input, $id);

        return $this->sendResponse($locomocion->toArray(), 'Locomocion updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/locomocions/{id}",
     *      summary="Remove the specified Locomocion from storage",
     *      tags={"Locomocion"},
     *      description="Delete Locomocion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Locomocion",
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
        /** @var Locomocion $locomocion */
        $locomocion = $this->locomocionRepository->find($id);

        if (empty($locomocion)) {
            return $this->sendError('Locomocion not found');
        }

        $locomocion->delete();

        return $this->sendSuccess('Locomocion deleted successfully');
    }
}
