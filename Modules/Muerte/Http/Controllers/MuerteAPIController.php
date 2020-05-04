<?php

namespace Modules\Muerte\Http\Controllers;

use Modules\Muerte\Http\Requests\CreateMuerteAPIRequest;
use Modules\Muerte\Http\Requests\UpdateMuerteAPIRequest;
use Modules\Muerte\Entities\Muerte;
use Modules\Muerte\Repositories\MuerteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MuerteController
 * @package Modules\Muerte\Http\Controllers
 */

class MuerteAPIController extends AppBaseController
{
    /** @var  MuerteRepository */
    private $muerteRepository;

    public function __construct(MuerteRepository $muerteRepo)
    {
        $this->muerteRepository = $muerteRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/muertes",
     *      summary="Get a listing of the Muertes.",
     *      tags={"Muerte"},
     *      description="Get all Muertes",
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
     *                  @SWG\Items(ref="#/definitions/Muerte")
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
        $muertes = $this->muerteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($muertes->toArray(), 'Muertes retrieved successfully');
    }

    /**
     * @param CreateMuerteAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/muertes",
     *      summary="Store a newly created Muerte in storage",
     *      tags={"Muerte"},
     *      description="Store Muerte",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Muerte that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Muerte")
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
     *                  ref="#/definitions/Muerte"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMuerteAPIRequest $request)
    {
        $input = $request->all();

        $muerte = $this->muerteRepository->create($input);

        return $this->sendResponse($muerte->toArray(), 'Muerte saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/muertes/{id}",
     *      summary="Display the specified Muerte",
     *      tags={"Muerte"},
     *      description="Get Muerte",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Muerte",
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
     *                  ref="#/definitions/Muerte"
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
        /** @var Muerte $muerte */
        $muerte = $this->muerteRepository->find($id);

        if (empty($muerte)) {
            return $this->sendError('Muerte not found');
        }

        return $this->sendResponse($muerte->toArray(), 'Muerte retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMuerteAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/muertes/{id}",
     *      summary="Update the specified Muerte in storage",
     *      tags={"Muerte"},
     *      description="Update Muerte",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Muerte",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Muerte that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Muerte")
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
     *                  ref="#/definitions/Muerte"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMuerteAPIRequest $request)
    {
        $input = $request->all();

        /** @var Muerte $muerte */
        $muerte = $this->muerteRepository->find($id);

        if (empty($muerte)) {
            return $this->sendError('Muerte not found');
        }

        $muerte = $this->muerteRepository->update($input, $id);

        return $this->sendResponse($muerte->toArray(), 'Muerte updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/muertes/{id}",
     *      summary="Remove the specified Muerte from storage",
     *      tags={"Muerte"},
     *      description="Delete Muerte",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Muerte",
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
        /** @var Muerte $muerte */
        $muerte = $this->muerteRepository->find($id);

        if (empty($muerte)) {
            return $this->sendError('Muerte not found');
        }

        $muerte->delete();

        return $this->sendSuccess('Muerte deleted successfully');
    }
}
