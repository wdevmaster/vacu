<?php

namespace Modules\Semen\Http\Controllers;

use Modules\Semen\Http\Requests\CreateSemenAPIRequest;
use Modules\Semen\Http\Requests\UpdateSemenAPIRequest;
use Modules\Semen\Entities\Semen;
use Modules\Semen\Repositories\SemenRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SemenController
 * @package Modules\Semen\Http\Controllers
 */

class SemenAPIController extends AppBaseController
{
    /** @var  SemenRepository */
    private $semenRepository;

    public function __construct(SemenRepository $semenRepo)
    {
        $this->semenRepository = $semenRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/api/v1/semen/semens",
     *      summary="Get a listing of the Semens.",
     *      tags={"Semen"},
     *      description="Get all Semens",
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
     *                  @SWG\Items(ref="#/definitions/Semen")
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
        $semens = $this->semenRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($semens->toArray(), 'Semens retrieved successfully');
    }

    /**
     * @param CreateSemenAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/api/v1/semen/semens",
     *      summary="Store a newly created Semen in storage",
     *      tags={"Semen"},
     *      description="Store Semen",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Semen that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Semen")
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
     *                  ref="#/definitions/Semen"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSemenAPIRequest $request)
    {
        $input = $request->all();

        $semen = $this->semenRepository->create($input);

        return $this->sendResponse($semen->toArray(), 'Semen saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/api/v1/semen/semens/{id}",
     *      summary="Display the specified Semen",
     *      tags={"Semen"},
     *      description="Get Semen",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Semen",
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
     *                  ref="#/definitions/Semen"
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
        /** @var Semen $semen */
        $semen = $this->semenRepository->find($id);

        if (empty($semen)) {
            return $this->sendError('Semen not found');
        }

        return $this->sendResponse($semen->toArray(), 'Semen retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSemenAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/api/v1/semen/semens/{id}",
     *      summary="Update the specified Semen in storage",
     *      tags={"Semen"},
     *      description="Update Semen",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Semen",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Semen that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Semen")
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
     *                  ref="#/definitions/Semen"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSemenAPIRequest $request)
    {
        $input = $request->all();

        /** @var Semen $semen */
        $semen = $this->semenRepository->find($id);

        if (empty($semen)) {
            return $this->sendError('Semen not found');
        }

        $semen = $this->semenRepository->update($input, $id);

        return $this->sendResponse($semen->toArray(), 'Semen updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/api/v1/semen/semens/{id}",
     *      summary="Remove the specified Semen from storage",
     *      tags={"Semen"},
     *      description="Delete Semen",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Semen",
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
        /** @var Semen $semen */
        $semen = $this->semenRepository->find($id);

        if (empty($semen)) {
            return $this->sendError('Semen not found');
        }

        $semen->delete();

        return $this->sendSuccess('Semen deleted successfully');
    }
}
