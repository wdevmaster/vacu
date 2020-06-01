<?php

namespace Modules\Finca\Http\Controllers;

use Modules\Finca\Http\Requests\CreateFincaAPIRequest;
use Modules\Finca\Http\Requests\UpdateFincaAPIRequest;
use Modules\Finca\Entities\Finca;
use Modules\Finca\Repositories\FincaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class FincaController
 * @package Modules\Finca\Http\Controllers
 */

class FincaAPIController extends AppBaseController
{
    /** @var  FincaRepository */
    private $fincaRepository;

    public function __construct(FincaRepository $fincaRepo)
    {
        $this->fincaRepository = $fincaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/api/v1/finca/fincas",
     *      summary="Get a listing of the Fincas.",
     *      tags={"Finca"},
     *      description="Get all Fincas",
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
     *                  @SWG\Items(ref="#/definitions/Finca")
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
        $fincas = $this->fincaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($fincas->toArray(), 'Fincas retrieved successfully');
    }

    /**
     * @param CreateFincaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/api/v1/finca/fincas",
     *      summary="Store a newly created Finca in storage",
     *      tags={"Finca"},
     *      description="Store Finca",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Finca that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Finca")
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
     *                  ref="#/definitions/Finca"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFincaAPIRequest $request)
    {
        $input = $request->all();

        $finca = $this->fincaRepository->create($input);

        return $this->sendResponse($finca->toArray(), 'Finca saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/api/v1/finca/fincas/{id}",
     *      summary="Display the specified Finca",
     *      tags={"Finca"},
     *      description="Get Finca",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Finca",
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
     *                  ref="#/definitions/Finca"
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
        /** @var Finca $finca */
        $finca = $this->fincaRepository->find($id);

        if (empty($finca)) {
            return $this->sendError('Finca not found');
        }

        return $this->sendResponse($finca->toArray(), 'Finca retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateFincaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/api/v1/finca/fincas/{id}",
     *      summary="Update the specified Finca in storage",
     *      tags={"Finca"},
     *      description="Update Finca",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Finca",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Finca that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Finca")
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
     *                  ref="#/definitions/Finca"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFincaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Finca $finca */
        $finca = $this->fincaRepository->find($id);

        if (empty($finca)) {
            return $this->sendError('Finca not found');
        }

        $finca = $this->fincaRepository->update($input, $id);

        return $this->sendResponse($finca->toArray(), 'Finca updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/api/v1/finca/fincas/{id}",
     *      summary="Remove the specified Finca from storage",
     *      tags={"Finca"},
     *      description="Delete Finca",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Finca",
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
        /** @var Finca $finca */
        $finca = $this->fincaRepository->find($id);

        if (empty($finca)) {
            return $this->sendError('Finca not found');
        }

        $finca->delete();

        return $this->sendSuccess('Finca deleted successfully');
    }
}
