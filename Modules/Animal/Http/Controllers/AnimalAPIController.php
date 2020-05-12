<?php

namespace Modules\Animal\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Animal\Entities\Animal;
use Modules\Animal\Http\Requests\CreateAnimalAPIRequest;
use Modules\Animal\Http\Requests\UpdateAnimalAPIRequest;
use Modules\Animal\Repositories\AnimalRepository;
use Modules\Common\Http\Controllers\CommonController;

/**
 * Class AnimalController
 * @package Modules\Animal\Http\Controllers
 */
class AnimalAPIController extends CommonController
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
     *      path="/api/v1/animal/animales",
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
        try {
            $animals = $this->animalRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );

            return $this->sendResponse($animals->toArray(),
                'comun::msgs.la_model_list_successfully',
                'animal::msgs.label_animal',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                'animal::msgs.label_animal',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                'animal::msgs.label_animal',
                false,
                500);
        }

    }

    /**
     * @param CreateAnimalAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/api/v1/animal/animales",
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
        try{
        $input = $request->all();

        $animal = $this->animalRepository->create($input);

            return $this->sendResponse($animal->toArray(),
                'comun::msgs.la_model_saved_successfully',
                'animal::msgs.label_animal',
                true,
                201);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                'animal::msgs.label_animal',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                'animal::msgs.label_animal',
                false,
                500);
        }
    }


    /**
     * @param int $id
     * @param UpdateAnimalAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/api/v1/animal/animales/{id}",
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
        try{
        $input = $request->all();

        $animal = $this->animalRepository->update($input, $id);

            return $this->sendResponse($animal->toArray(),
                'comun::msgs.la_model_updated_successfully',
                'animal::msgs.label_animal',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                'animal::msgs.label_animal',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                'animal::msgs.label_animal',
                false,
                500);
        }
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/api/v1/animal/animales/{id}",
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
        try{
        /** @var Animal $animal */
        $animal = $this->animalRepository->find($id);

        $animal->active = false;
        $result = $this->animalRepository->update($animal->toArray(), $animal->id);

            return $this->sendResponse($result->toArray(),
                'comun::msgs.la_model_desactivated_successfully',
                'animal::msgs.label_animal',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                'animal::msgs.label_animal',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                'animal::msgs.label_animal',
                false,
                500);
        }
    }
}
