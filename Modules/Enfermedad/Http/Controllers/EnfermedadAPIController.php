<?php

namespace Modules\Enfermedad\Http\Controllers;

use Modules\Enfermedad\Http\Requests\CreateEnfermedadAPIRequest;
use Modules\Enfermedad\Http\Requests\UpdateEnfermedadAPIRequest;
use Modules\Enfermedad\Entities\Enfermedad;
use Modules\Enfermedad\Repositories\EnfermedadRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EnfermedadController
 * @package Modules\Enfermedad\Http\Controllers
 */

class EnfermedadAPIController extends AppBaseController
{
    /** @var  EnfermedadRepository */
    private $enfermedadRepository;

    public function __construct(EnfermedadRepository $enfermedadRepo)
    {
        $this->enfermedadRepository = $enfermedadRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/enfermedads",
     *      summary="Get a listing of the Enfermedads.",
     *      tags={"Enfermedad"},
     *      description="Get all Enfermedads",
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
     *                  @SWG\Items(ref="#/definitions/Enfermedad")
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
        $enfermedads = $this->enfermedadRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($enfermedads->toArray(), 'Enfermedads retrieved successfully');
    }

    /**
     * @param CreateEnfermedadAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/enfermedads",
     *      summary="Store a newly created Enfermedad in storage",
     *      tags={"Enfermedad"},
     *      description="Store Enfermedad",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Enfermedad that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Enfermedad")
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
     *                  ref="#/definitions/Enfermedad"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEnfermedadAPIRequest $request)
    {
        $input = $request->all();

        $enfermedad = $this->enfermedadRepository->create($input);

        return $this->sendResponse($enfermedad->toArray(), 'Enfermedad saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/enfermedads/{id}",
     *      summary="Display the specified Enfermedad",
     *      tags={"Enfermedad"},
     *      description="Get Enfermedad",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Enfermedad",
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
     *                  ref="#/definitions/Enfermedad"
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
        /** @var Enfermedad $enfermedad */
        $enfermedad = $this->enfermedadRepository->find($id);

        if (empty($enfermedad)) {
            return $this->sendError('Enfermedad not found');
        }

        return $this->sendResponse($enfermedad->toArray(), 'Enfermedad retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateEnfermedadAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/enfermedads/{id}",
     *      summary="Update the specified Enfermedad in storage",
     *      tags={"Enfermedad"},
     *      description="Update Enfermedad",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Enfermedad",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Enfermedad that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Enfermedad")
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
     *                  ref="#/definitions/Enfermedad"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEnfermedadAPIRequest $request)
    {
        $input = $request->all();

        /** @var Enfermedad $enfermedad */
        $enfermedad = $this->enfermedadRepository->find($id);

        if (empty($enfermedad)) {
            return $this->sendError('Enfermedad not found');
        }

        $enfermedad = $this->enfermedadRepository->update($input, $id);

        return $this->sendResponse($enfermedad->toArray(), 'Enfermedad updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/enfermedads/{id}",
     *      summary="Remove the specified Enfermedad from storage",
     *      tags={"Enfermedad"},
     *      description="Delete Enfermedad",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Enfermedad",
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
        /** @var Enfermedad $enfermedad */
        $enfermedad = $this->enfermedadRepository->find($id);

        if (empty($enfermedad)) {
            return $this->sendError('Enfermedad not found');
        }

        $enfermedad->delete();

        return $this->sendSuccess('Enfermedad deleted successfully');
    }
}
