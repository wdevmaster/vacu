<?php

namespace Modules\Sincronizacion\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Modules\Sincronizacion\Http\Requests\CreateSyncronizacionAPIRequest;
use Modules\Sincronizacion\Repositories\SyncronizacionRepository;
use Modules\Sincronizacion\Services\SyncDataServiceInterface;

/**
 * Class SyncronizacionController
 * @package Modules\Sincronizacion\Http\Controllers
 */
class SyncronizacionAPIController extends AppBaseController
{
    /** @var  SyncronizacionRepository */
    private $syncronizacionRepository;

    /**
     * @var SyncDataServiceInterface
     */
    private $syncDataService;

    public function __construct(SyncronizacionRepository $syncronizacionRepo, SyncDataServiceInterface $syncDataService)
    {
        $this->syncronizacionRepository = $syncronizacionRepo;
        $this->syncDataService = $syncDataService;
    }

    /**
     * @param CreateSyncronizacionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/api/v1/sincronizacion/sincronizaciones",
     *      summary="Store a newly created Syncronizacion in storage",
     *      tags={"Syncronizacion"},
     *      description="Store Syncronizacion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Syncronizacion that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Syncronizacion")
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
     *                  ref="#/definitions/Syncronizacion"
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
    public function store(CreateSyncronizacionAPIRequest $request)
    {
        try {
            $input = $request->all();
            $input['data'] = json_encode($input['data']);

            $sincronizacion = $this->syncronizacionRepository->create($input);

            return response()->json([
                'message' => __('comun::msgs.la_model_saved_successfully', [
                    'model' => trans_choice('configuracion::msgs.label_sincronizacion', 1)
                ]),
                'success' => true,
                'data' => $sincronizacion
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => __('comun::msgs.la_model_not_found', [
                    'model' => trans_choice('usuario::msgs.label_sincronizacion', 1)
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
     * @param CreateSyncronizacionAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/sincronizacion/sincronizaciones/start",
     *      summary="Start syncronization ",
     *      tags={"Syncronizacion"},
     *      description="Store Syncronizacion",
     *      produces={"application/json"},
     *
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
     *                  @SWG\Items(
     *                       @SWG\Property(
     *                           property="tabla",
     *                           type="string",
     *                           example="data_configuraciones"
     *                      )
     *                )
     *              ),
     *
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
    public function startSync()
    {
       // try {
            $results = $this->syncDataService->executeService();

            return response()->json([
                'message' => __('comun::msgs.la_model_sync_successfully', [
                    'model' => trans_choice('configuracion::msgs.label_sincronizacion', 1)
                ]),
                'success' => true,
                'data' => $results
            ], 200);
      //  }
//        catch (\Exception $e) {
//            return response()->json([
//                'message' => __('comun::msgs.msg_error_contact_the_administrator'),
//                'success' => false
//            ], 500);
//        }
    }
}
