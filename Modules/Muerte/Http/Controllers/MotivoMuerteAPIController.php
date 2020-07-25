<?php

namespace Modules\Muerte\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Muerte\Http\Requests\CreateMotivoMuerteAPIRequest;
use Modules\Muerte\Http\Requests\UpdateMotivoMuerteAPIRequest;
use Modules\Muerte\Entities\MotivoMuerte;
use Modules\Muerte\Repositories\MotivoMuerteRepository;
use Illuminate\Http\Request;

/**
 * Class MotivoMuerteController
 * @package Modules\Muerte\Http\Controllers
 */

class MotivoMuerteAPIController extends CommonController
{
    /** @var  MotivoMuerteRepository */
    private $motivoMuerteRepository;

    public function __construct(MotivoMuerteRepository $motivoMuerteRepo)
    {
        $this->motivoMuerteRepository = $motivoMuerteRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/muerte/motivo_muertes",
     *      summary="Get a listing of the MotivoMuertes.",
     *      tags={"MotivoMuerte"},
     *      description="Get all MotivoMuertes",
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
     *                  @SWG\Items(ref="#/definitions/MotivoMuerte")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *      security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function index(Request $request)
    {
        try{
            $paginate = isset($request->paginado) ? $request->paginado : null;
            if ($paginate) {
                $motivoMuertes = $this->motivoMuerteRepository->paginate($paginate);
            } else {

                $motivoMuertes = $this->motivoMuerteRepository->all(
                    $request->except(['skip', 'limit']),
                    $request->get('skip'),
                    $request->get('limit')
                );
            }

                return $this->sendResponse($motivoMuertes->toArray(),
                    'comun::msgs.la_model_list_successfully',
                    true,
                    200);

            } catch (ModelNotFoundException $e) {
                return $this->sendResponse([],
                    'comun::msgs.la_model_not_found',
                    false,
                    404);
            } catch
        (\Exception $e) {

                return $this->sendResponse([],
                    'comun::msgs.msg_error_contact_the_administrator',
                    false,
                    500);
            }
    }

    /**
     * @param CreateMotivoMuerteAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/muerte/motivo_muertes",
     *      summary="Store a newly created MotivoMuerte in storage",
     *      tags={"MotivoMuerte"},
     *      description="Store MotivoMuerte",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MotivoMuerte that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MotivoMuerte")
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
     *                  ref="#/definitions/MotivoMuerte"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *      security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function store(CreateMotivoMuerteAPIRequest $request)
    {
        try{

        $input = $request->all();

        $motivoMuerte = $this->motivoMuerteRepository->create($input);

            return $this->sendResponse($motivoMuerte->toArray(),
                'comun::msgs.la_model_saved_successfully',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                false,
                500);
        }
    }



    /**
     * @param int $id
     * @param UpdateMotivoMuerteAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/muerte/motivo_muertes/{id}",
     *      summary="Update the specified MotivoMuerte in storage",
     *      tags={"MotivoMuerte"},
     *      description="Update MotivoMuerte",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MotivoMuerte",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MotivoMuerte that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MotivoMuerte")
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
     *                  ref="#/definitions/MotivoMuerte"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *      security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function update($id, UpdateMotivoMuerteAPIRequest $request)
    {
        try{

        $input = $request->all();

        /** @var MotivoMuerte $motivoMuerte */
        $this->motivoMuerteRepository->find($id);

         $motivoMuerte = $this->motivoMuerteRepository->update($input, $id);

        return $this->sendResponse($motivoMuerte->toArray(),
            'comun::msgs.la_model_updated_successfully',
            true,
                    200);

            } catch (ModelNotFoundException $e) {
        return $this->sendResponse([],
        'comun::msgs.la_model_not_found',
        false,
        404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                false,
                500);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/api/v1/muerte/motivo_muertes/{id}",
     *      summary="Remove the specified MotivoMuerte from storage",
     *      tags={"MotivoMuerte"},
     *      description="Delete MotivoMuerte",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MotivoMuerte",
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
     *      ),
     *      security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function destroy($id)
    {
        try{

        /** @var MotivoMuerte $motivoMuerte */
        $motivoMuerte = $this->motivoMuerteRepository->find($id);
        $motivoMuerte->active=false;
        $result= $this->motivoMuerteRepository->update($motivoMuerte->toArray(),$motivoMuerte->id);

        return $this->sendResponse($result->toArray(),
            'comun::msgs.la_model_desactivated_successfully',
            true,
            200);

            } catch (ModelNotFoundException $e) {
        return $this->sendResponse([],
        'comun::msgs.la_model_not_found',
        false,
        404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                false,
                500);
        }
            }
}
