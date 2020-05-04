<?php

namespace Modules\Animal\Http\Controllers;

use Modules\Animal\Http\Requests\CreateAnimalAPIRequest;
use Modules\Animal\Http\Requests\UpdateAnimalAPIRequest;
use Modules\Animal\Entities\Animal;
use Modules\Animal\Repositories\AnimalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AnimalController
 * @package Modules\Animal\Http\Controllers
 */

class AnimalAPIController extends AppBaseController
{
    /** @var  AnimalRepository */
    private $animalRepository;

    public function __construct(AnimalRepository $animalRepo)
    {
        $this->animalRepository = $animalRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/animals",
     *      summary="Get a listing of the Animals.",
     *      tags={"Animal"},
     *      description="Get all Animals",
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
     *                  @SWG\Items(ref="#/definitions/Animal")
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
        $animals = $this->animalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($animals->toArray(), 'Animals retrieved successfully');
    }

    /**
     * @param CreateAnimalAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/animals",
     *      summary="Store a newly created Animal in storage",
     *      tags={"Animal"},
     *      description="Store Animal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Animal that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Animal")
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
     *                  ref="#/definitions/Animal"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAnimalAPIRequest $request)
    {
        $input = $request->all();

        $animal = $this->animalRepository->create($input);

        return $this->sendResponse($animal->toArray(), 'Animal saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/animals/{id}",
     *      summary="Display the specified Animal",
     *      tags={"Animal"},
     *      description="Get Animal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Animal",
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
     *                  ref="#/definitions/Animal"
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
        /** @var Animal $animal */
        $animal = $this->animalRepository->find($id);

        if (empty($animal)) {
            return $this->sendError('Animal not found');
        }

        return $this->sendResponse($animal->toArray(), 'Animal retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAnimalAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/animals/{id}",
     *      summary="Update the specified Animal in storage",
     *      tags={"Animal"},
     *      description="Update Animal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Animal",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Animal that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Animal")
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
     *                  ref="#/definitions/Animal"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAnimalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Animal $animal */
        $animal = $this->animalRepository->find($id);

        if (empty($animal)) {
            return $this->sendError('Animal not found');
        }

        $animal = $this->animalRepository->update($input, $id);

        return $this->sendResponse($animal->toArray(), 'Animal updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/animals/{id}",
     *      summary="Remove the specified Animal from storage",
     *      tags={"Animal"},
     *      description="Delete Animal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Animal",
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
        /** @var Animal $animal */
        $animal = $this->animalRepository->find($id);

        if (empty($animal)) {
            return $this->sendError('Animal not found');
        }

        $animal->delete();

        return $this->sendSuccess('Animal deleted successfully');
    }
}
