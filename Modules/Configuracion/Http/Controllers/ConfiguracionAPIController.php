<?php

namespace Modules\Configuracion\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Configuracion\Entities\Configuracion;
use Modules\Configuracion\Http\Requests\CreateConfiguracionAPIRequest;
use Modules\Configuracion\Http\Requests\UpdateConfiguracionAPIRequest;
use Modules\Configuracion\Repositories\ConfiguracionRepository;

/**
 * Class ConfiguracionController
 * @package Modules\Configuracion\Http\Controllers
 */
class ConfiguracionAPIController extends CommonController
{
    /** @var  ConfiguracionRepository */
    private $configuracionRepository;

    public function __construct(ConfiguracionRepository $configuracionRepo)
    {
        $this->configuracionRepository = $configuracionRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/configuracion/configuraciones",
     *      summary="Get a listing of the Configuracions.",
     *      tags={"Configuracion"},
     *      description="Get all Configuracions",
     *      produces={"application/json"},
     *     @SWG\Parameter(
     *          name="paginado",
     *          in="query",
     *          type="integer",
     *          description="Paginado",
     *          required=false,
     *          @SWG\Schema(
     *               @SWG\Property(
     *                  property="paginate",
     *                  type="integer"
     *              ),
     *         )
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
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Configuracion")
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
        try {
            $paginate = isset($request->paginado) ? $request->paginado : null;

            if ($paginate) {
                $configuraciones = $this->configuracionRepository->paginate($paginate);
            } else {
                $configuraciones = $this->configuracionRepository->all(
                    $request->except(['skip', 'limit']),
                    $request->get('skip'),
                    $request->get('limit')
                );
            }


            return response()->json([
                'message' => __('comun::msgs.la_model_updated_successfully', [
                    'model' => trans_choice('configuracion::msgs.label_configuracion', 1)
                ]),
                'success' => true,
                'data' => $configuraciones
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => __('comun::msgs.la_model_not_found', ['model' => trans_choice('usuario::msgs.label_usuario', 1)]),
                'success' => false], 404);
        } catch
        (\Exception $e) {
            return response()->json([
                'message' => __('comun::msgs.msg_error_contact_the_administrator'),
                'success' => false
            ], 500);
        }
    }

    /**
     * @param CreateConfiguracionAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/configuracion/configuraciones",
     *      summary="Store a newly created Configuracion in storage",
     *      tags={"Configuracion"},
     *      description="Store Configuracion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Configuracion that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Configuracion")
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
     *                  ref="#/definitions/Configuracion"
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
    public function store(CreateConfiguracionAPIRequest $request)
    {
        try {
            $input = $request->all();

            $configuracion = $this->configuracionRepository->create($input);

            return response()->json([
                'message' => __('comun::msgs.la_model_saved_successfully', [
                    'model' => trans_choice('configuracion::msgs.label_configuracion', 1)
                ]),
                'success' => true,
                'data' => $configuracion
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => __('comun::msgs.la_model_not_found', [
                    'model' => trans_choice('configuracion::msgs.label_configuracion', 1)
                ]),
                'success' => false
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => __('comun::msgs.msg_error_contact_the_administrator'),
                'success' => false
            ], 500);
        }
    }

    /**
     * @param int $id
     * @param UpdateConfiguracionAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/configuracion/configuraciones/{id}",
     *      summary="Update the specified Configuracion in storage",
     *      tags={"Configuracion"},
     *      description="Update Configuracion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Configuracion",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Configuracion that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Configuracion")
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
     *                  ref="#/definitions/Configuracion"
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
    public function update($id, UpdateConfiguracionAPIRequest $request)
    {
        try {
            $input = $request->all();

            /** @var Configuracion $configuracion */
            $configuracion = $this->configuracionRepository->find($id);

            if (empty($configuracion)) {
                return $this->sendError('User not found', 404);
            }

            $configuracion = $this->configuracionRepository->update($input, $id);

            return response()->json([
                'message' => __('comun::msgs.la_model_updated_successfully', [
                    'model' => trans_choice('usuario::msgs.label_configuracion', 1)
                ]),
                'success' => true,
                'data' => $configuracion
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => __('comun::msgs.la_model_not_found', [
                    'model' => trans_choice('usuario::msgs.configuracion', 1)
                ]),
                'success' => false
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => __('comun::msgs.msg_error_contact_the_administrator'),
                'success' => false
            ], 500);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Delete(
     *      path="/api/v1/configuracion/configuraciones/{id}",
     *      summary="Remove the specified Configuracion from storage",
     *      tags={"Configuracion"},
     *      description="Delete Configuracion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Configuracion",
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
     * @throws \Exception
     */
    public function destroy($id)
    {
        try {
            /** @var Configuracion $configuracion */
            $configuracion = $this->configuracionRepository->find($id);

            $configuracion->active = false;
            $result = $this->configuracionRepository->update($configuracion->toArray(), $configuracion->id);

            return $this->sendResponse($result->toArray(),
                'comun::msgs.la_model_desactivated_successfully',
                true,
                200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => __('comun::msgs.la_model_not_found', [
                    'model' => trans_choice('usuario::msgs.label_configuracion', 1)
                ]),
                'success' => false
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => __('comun::msgs.msg_error_contact_the_administrator'),
                'success' => false
            ], 500);
        }
    }
}
