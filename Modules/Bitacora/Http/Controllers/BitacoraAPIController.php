<?php

namespace Modules\Bitacora\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Modules\Bitacora\Http\Requests\CreateBitacoraAPIRequest;
use Modules\Bitacora\Http\Requests\UpdateBitacoraAPIRequest;
use Modules\Bitacora\Entities\Bitacora;
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
     *      path="/api/v1/bitacoras/bitacora",
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
     *      )
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

//    /**
//     * @param CreateBitacoraAPIRequest $request
//     * @return Response
//     *
//     * @SWG\Post(
//     *      path="/bitacoras",
//     *      summary="Store a newly created Bitacora in storage",
//     *      tags={"Bitacora"},
//     *      description="Store Bitacora",
//     *      produces={"application/json"},
//     *      @SWG\Parameter(
//     *          name="body",
//     *          in="body",
//     *          description="Bitacora that should be stored",
//     *          required=false,
//     *          @SWG\Schema(ref="#/definitions/Bitacora")
//     *      ),
//     *      @SWG\Response(
//     *          response=200,
//     *          description="successful operation",
//     *          @SWG\Schema(
//     *              type="object",
//     *              @SWG\Property(
//     *                  property="success",
//     *                  type="boolean"
//     *              ),
//     *              @SWG\Property(
//     *                  property="data",
//     *                  ref="#/definitions/Bitacora"
//     *              ),
//     *              @SWG\Property(
//     *                  property="message",
//     *                  type="string"
//     *              )
//     *          )
//     *      )
//     * )
//     */
//    public function store(CreateBitacoraAPIRequest $request)
//    {
//        $input = $request->all();
//
//        $bitacora = $this->bitacoraRepository->create($input);
//
//        return $this->sendResponse($bitacora->toArray(), 'Bitacora saved successfully');
//    }
//
//    /**
//     * @param int $id
//     * @return Response
//     *
//     * @SWG\Get(
//     *      path="/bitacoras/{id}",
//     *      summary="Display the specified Bitacora",
//     *      tags={"Bitacora"},
//     *      description="Get Bitacora",
//     *      produces={"application/json"},
//     *      @SWG\Parameter(
//     *          name="id",
//     *          description="id of Bitacora",
//     *          type="integer",
//     *          required=true,
//     *          in="path"
//     *      ),
//     *      @SWG\Response(
//     *          response=200,
//     *          description="successful operation",
//     *          @SWG\Schema(
//     *              type="object",
//     *              @SWG\Property(
//     *                  property="success",
//     *                  type="boolean"
//     *              ),
//     *              @SWG\Property(
//     *                  property="data",
//     *                  ref="#/definitions/Bitacora"
//     *              ),
//     *              @SWG\Property(
//     *                  property="message",
//     *                  type="string"
//     *              )
//     *          )
//     *      )
//     * )
//     */
//    public function show($id)
//    {
//        /** @var Bitacora $bitacora */
//        $bitacora = $this->bitacoraRepository->find($id);
//
//        if (empty($bitacora)) {
//            return $this->sendError('Bitacora not found');
//        }
//
//        return $this->sendResponse($bitacora->toArray(), 'Bitacora retrieved successfully');
//    }
//
//    /**
//     * @param int $id
//     * @param UpdateBitacoraAPIRequest $request
//     * @return Response
//     *
//     * @SWG\Put(
//     *      path="/bitacoras/{id}",
//     *      summary="Update the specified Bitacora in storage",
//     *      tags={"Bitacora"},
//     *      description="Update Bitacora",
//     *      produces={"application/json"},
//     *      @SWG\Parameter(
//     *          name="id",
//     *          description="id of Bitacora",
//     *          type="integer",
//     *          required=true,
//     *          in="path"
//     *      ),
//     *      @SWG\Parameter(
//     *          name="body",
//     *          in="body",
//     *          description="Bitacora that should be updated",
//     *          required=false,
//     *          @SWG\Schema(ref="#/definitions/Bitacora")
//     *      ),
//     *      @SWG\Response(
//     *          response=200,
//     *          description="successful operation",
//     *          @SWG\Schema(
//     *              type="object",
//     *              @SWG\Property(
//     *                  property="success",
//     *                  type="boolean"
//     *              ),
//     *              @SWG\Property(
//     *                  property="data",
//     *                  ref="#/definitions/Bitacora"
//     *              ),
//     *              @SWG\Property(
//     *                  property="message",
//     *                  type="string"
//     *              )
//     *          )
//     *      )
//     * )
//     */
//    public function update($id, UpdateBitacoraAPIRequest $request)
//    {
//        $input = $request->all();
//
//        /** @var Bitacora $bitacora */
//        $bitacora = $this->bitacoraRepository->find($id);
//
//        if (empty($bitacora)) {
//            return $this->sendError('Bitacora not found');
//        }
//
//        $bitacora = $this->bitacoraRepository->update($input, $id);
//
//        return $this->sendResponse($bitacora->toArray(), 'Bitacora updated successfully');
//    }
//
//    /**
//     * @param int $id
//     * @return Response
//     *
//     * @SWG\Delete(
//     *      path="/bitacoras/{id}",
//     *      summary="Remove the specified Bitacora from storage",
//     *      tags={"Bitacora"},
//     *      description="Delete Bitacora",
//     *      produces={"application/json"},
//     *      @SWG\Parameter(
//     *          name="id",
//     *          description="id of Bitacora",
//     *          type="integer",
//     *          required=true,
//     *          in="path"
//     *      ),
//     *      @SWG\Response(
//     *          response=200,
//     *          description="successful operation",
//     *          @SWG\Schema(
//     *              type="object",
//     *              @SWG\Property(
//     *                  property="success",
//     *                  type="boolean"
//     *              ),
//     *              @SWG\Property(
//     *                  property="data",
//     *                  type="string"
//     *              ),
//     *              @SWG\Property(
//     *                  property="message",
//     *                  type="string"
//     *              )
//     *          )
//     *      )
//     * )
//     */
//    public function destroy($id)
//    {
//        /** @var Bitacora $bitacora */
//        $bitacora = $this->bitacoraRepository->find($id);
//
//        if (empty($bitacora)) {
//            return $this->sendError('Bitacora not found');
//        }
//
//        $bitacora->delete();
//
//        return $this->sendSuccess('Bitacora deleted successfully');
//    }
}
