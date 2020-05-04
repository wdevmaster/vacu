<?php

namespace Modules\Inseminador\Http\Controllers;

use Modules\Inseminador\Http\Requests\CreateInseminadorAPIRequest;
use Modules\Inseminador\Http\Requests\UpdateInseminadorAPIRequest;
use Modules\Inseminador\Entities\Inseminador;
use Modules\Inseminador\Repositories\InseminadorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class InseminadorController
 * @package Modules\Inseminador\Http\Controllers
 */

class InseminadorAPIController extends AppBaseController
{
    /** @var  InseminadorRepository */
    private $inseminadorRepository;

    public function __construct(InseminadorRepository $inseminadorRepo)
    {
        $this->inseminadorRepository = $inseminadorRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/inseminadors",
     *      summary="Get a listing of the Inseminadors.",
     *      tags={"Inseminador"},
     *      description="Get all Inseminadors",
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
     *                  @SWG\Items(ref="#/definitions/Inseminador")
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
        $inseminadors = $this->inseminadorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($inseminadors->toArray(), 'Inseminadors retrieved successfully');
    }

    /**
     * @param CreateInseminadorAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/inseminadors",
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
     *      )
     * )
     */
    public function store(CreateInseminadorAPIRequest $request)
    {
        $input = $request->all();

        $inseminador = $this->inseminadorRepository->create($input);

        return $this->sendResponse($inseminador->toArray(), 'Inseminador saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/inseminadors/{id}",
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
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Inseminador $inseminador */
        $inseminador = $this->inseminadorRepository->find($id);

        if (empty($inseminador)) {
            return $this->sendError('Inseminador not found');
        }

        return $this->sendResponse($inseminador->toArray(), 'Inseminador retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateInseminadorAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/inseminadors/{id}",
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
     *      )
     * )
     */
    public function update($id, UpdateInseminadorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Inseminador $inseminador */
        $inseminador = $this->inseminadorRepository->find($id);

        if (empty($inseminador)) {
            return $this->sendError('Inseminador not found');
        }

        $inseminador = $this->inseminadorRepository->update($input, $id);

        return $this->sendResponse($inseminador->toArray(), 'Inseminador updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/inseminadors/{id}",
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
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Inseminador $inseminador */
        $inseminador = $this->inseminadorRepository->find($id);

        if (empty($inseminador)) {
            return $this->sendError('Inseminador not found');
        }

        $inseminador->delete();

        return $this->sendSuccess('Inseminador deleted successfully');
    }
}
