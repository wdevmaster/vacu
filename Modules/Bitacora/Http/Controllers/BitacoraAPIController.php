<?php

namespace Modules\Bitacora\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\Bitacora\Repositories\BitacoraRepository;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;

/**
 * Class BitacoraController
 * @package Modules\Bitacora\Http\Controllers
 */

class BitacoraAPIController extends CommonController
{
    /** @var  BitacoraRepository */
    private $bitacoraRepository;

    public function __construct(BitacoraRepository $bitacoraRepo)
    {
        $this->bitacoraRepository = $bitacoraRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/bitacora/bitacoras",
     *      summary="Get a listing of the Bitacoras.",
     *      tags={"Bitacora"},
     *      description="Get all Bitacoras",
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
     *                  @SWG\Items(ref="#/definitions/Bitacora")
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
                $bitacoras = $this->bitacoraRepository->paginate($paginate);
            } else {
                $bitacoras = $this->bitacoraRepository->all(
                    $request->except(['skip', 'limit']),
                    $request->get('skip'),
                    $request->get('limit')
                );

            }
                return $this->sendResponse($bitacoras->toArray(),
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
}
