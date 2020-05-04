<?php

namespace Modules\CondicionCorporal\Http\Controllers;

use Modules\CondicionCorporal\Http\Requests\CreateCondicionCorporalAPIRequest;
use Modules\CondicionCorporal\Http\Requests\UpdateCondicionCorporalAPIRequest;
use Modules\CondicionCorporal\Entities\CondicionCorporal;
use Modules\CondicionCorporal\Repositories\CondicionCorporalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CondicionCorporalController
 * @package Modules\CondicionCorporal\Http\Controllers
 */

class CondicionCorporalAPIController extends AppBaseController
{
    /** @var  CondicionCorporalRepository */
    private $condicionCorporalRepository;

    public function __construct(CondicionCorporalRepository $condicionCorporalRepo)
    {
        $this->condicionCorporalRepository = $condicionCorporalRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/condicionCorporals",
     *      summary="Get a listing of the CondicionCorporals.",
     *      tags={"CondicionCorporal"},
     *      description="Get all CondicionCorporals",
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
     *                  @SWG\Items(ref="#/definitions/CondicionCorporal")
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
        $condicionCorporals = $this->condicionCorporalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($condicionCorporals->toArray(), 'Condicion Corporals retrieved successfully');
    }

    /**
     * @param CreateCondicionCorporalAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/condicionCorporals",
     *      summary="Store a newly created CondicionCorporal in storage",
     *      tags={"CondicionCorporal"},
     *      description="Store CondicionCorporal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CondicionCorporal that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CondicionCorporal")
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
     *                  ref="#/definitions/CondicionCorporal"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCondicionCorporalAPIRequest $request)
    {
        $input = $request->all();

        $condicionCorporal = $this->condicionCorporalRepository->create($input);

        return $this->sendResponse($condicionCorporal->toArray(), 'Condicion Corporal saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/condicionCorporals/{id}",
     *      summary="Display the specified CondicionCorporal",
     *      tags={"CondicionCorporal"},
     *      description="Get CondicionCorporal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CondicionCorporal",
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
     *                  ref="#/definitions/CondicionCorporal"
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
        /** @var CondicionCorporal $condicionCorporal */
        $condicionCorporal = $this->condicionCorporalRepository->find($id);

        if (empty($condicionCorporal)) {
            return $this->sendError('Condicion Corporal not found');
        }

        return $this->sendResponse($condicionCorporal->toArray(), 'Condicion Corporal retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCondicionCorporalAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/condicionCorporals/{id}",
     *      summary="Update the specified CondicionCorporal in storage",
     *      tags={"CondicionCorporal"},
     *      description="Update CondicionCorporal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CondicionCorporal",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CondicionCorporal that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CondicionCorporal")
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
     *                  ref="#/definitions/CondicionCorporal"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCondicionCorporalAPIRequest $request)
    {
        $input = $request->all();

        /** @var CondicionCorporal $condicionCorporal */
        $condicionCorporal = $this->condicionCorporalRepository->find($id);

        if (empty($condicionCorporal)) {
            return $this->sendError('Condicion Corporal not found');
        }

        $condicionCorporal = $this->condicionCorporalRepository->update($input, $id);

        return $this->sendResponse($condicionCorporal->toArray(), 'CondicionCorporal updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/condicionCorporals/{id}",
     *      summary="Remove the specified CondicionCorporal from storage",
     *      tags={"CondicionCorporal"},
     *      description="Delete CondicionCorporal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CondicionCorporal",
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
        /** @var CondicionCorporal $condicionCorporal */
        $condicionCorporal = $this->condicionCorporalRepository->find($id);

        if (empty($condicionCorporal)) {
            return $this->sendError('Condicion Corporal not found');
        }

        $condicionCorporal->delete();

        return $this->sendSuccess('Condicion Corporal deleted successfully');
    }
}
