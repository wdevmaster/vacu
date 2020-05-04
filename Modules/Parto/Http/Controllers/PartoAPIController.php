<?php

namespace Modules\Parto\Http\Controllers;

use Modules\Parto\Http\Requests\CreatePartoAPIRequest;
use Modules\Parto\Http\Requests\UpdatePartoAPIRequest;
use Modules\Parto\Entities\Parto;
use Modules\Parto\Repositories\PartoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PartoController
 * @package Modules\Parto\Http\Controllers
 */

class PartoAPIController extends AppBaseController
{
    /** @var  PartoRepository */
    private $partoRepository;

    public function __construct(PartoRepository $partoRepo)
    {
        $this->partoRepository = $partoRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/partos",
     *      summary="Get a listing of the Partos.",
     *      tags={"Parto"},
     *      description="Get all Partos",
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
     *                  @SWG\Items(ref="#/definitions/Parto")
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
        $partos = $this->partoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($partos->toArray(), 'Partos retrieved successfully');
    }

    /**
     * @param CreatePartoAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/partos",
     *      summary="Store a newly created Parto in storage",
     *      tags={"Parto"},
     *      description="Store Parto",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Parto that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Parto")
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
     *                  ref="#/definitions/Parto"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePartoAPIRequest $request)
    {
        $input = $request->all();

        $parto = $this->partoRepository->create($input);

        return $this->sendResponse($parto->toArray(), 'Parto saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/partos/{id}",
     *      summary="Display the specified Parto",
     *      tags={"Parto"},
     *      description="Get Parto",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Parto",
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
     *                  ref="#/definitions/Parto"
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
        /** @var Parto $parto */
        $parto = $this->partoRepository->find($id);

        if (empty($parto)) {
            return $this->sendError('Parto not found');
        }

        return $this->sendResponse($parto->toArray(), 'Parto retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePartoAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/partos/{id}",
     *      summary="Update the specified Parto in storage",
     *      tags={"Parto"},
     *      description="Update Parto",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Parto",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Parto that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Parto")
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
     *                  ref="#/definitions/Parto"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePartoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Parto $parto */
        $parto = $this->partoRepository->find($id);

        if (empty($parto)) {
            return $this->sendError('Parto not found');
        }

        $parto = $this->partoRepository->update($input, $id);

        return $this->sendResponse($parto->toArray(), 'Parto updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/partos/{id}",
     *      summary="Remove the specified Parto from storage",
     *      tags={"Parto"},
     *      description="Delete Parto",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Parto",
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
        /** @var Parto $parto */
        $parto = $this->partoRepository->find($id);

        if (empty($parto)) {
            return $this->sendError('Parto not found');
        }

        $parto->delete();

        return $this->sendSuccess('Parto deleted successfully');
    }
}
