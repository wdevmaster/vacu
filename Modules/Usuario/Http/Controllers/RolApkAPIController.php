<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Usuario\Http\Requests\CreateRolApkAPIRequest;
use Modules\Usuario\Http\Requests\UpdateRolApkAPIRequest;
use Modules\Usuario\Entities\RolApk;
use Modules\Usuario\Repositories\RolApkRepository;
use Illuminate\Http\Request;

/**
 * Class RolApkController
 * @package Modules\Usuario\Http\Controllers
 */

class RolApkAPIController extends CommonController
{
    /** @var  RolApkRepository */
    private $rolApkRepository;

    public function __construct(RolApkRepository $rolApkRepo)
    {
        $this->rolApkRepository = $rolApkRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/rol_apk/roles_apks",
     *      summary="Get a listing of the RolApks.",
     *      tags={"RolApk"},
     *      description="Get all RolApks",
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
     *                  @SWG\Items(ref="#/definitions/RolApk")
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
        $rolApks = $this->rolApkRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($rolApks->toArray(), 'Rol Apks retrieved successfully');
    }

    /**
     * @param CreateRolApkAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/rol_apk/roles_apks",
     *      summary="Store a newly created RolApk in storage",
     *      tags={"RolApk"},
     *      description="Store RolApk",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RolApk that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RolApk")
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
     *                  ref="#/definitions/RolApk"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRolApkAPIRequest $request)
    {
        $input = $request->all();

        $rolApk = $this->rolApkRepository->create($input);

        return $this->sendResponse($rolApk->toArray(), 'Rol Apk saved successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/rol_apk/roles_apks/{id}",
     *      summary="Display the specified RolApk",
     *      tags={"RolApk"},
     *      description="Get RolApk",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RolApk",
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
     *                  ref="#/definitions/RolApk"
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
        /** @var RolApk $rolApk */
        $rolApk = $this->rolApkRepository->find($id);

        if (empty($rolApk)) {
            return $this->sendError('Rol Apk not found', 404);
        }

        return $this->sendResponse($rolApk->toArray(), 'Rol Apk retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRolApkAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/api/v1/rol_apk/roles_apks/{id}",
     *      summary="Update the specified RolApk in storage",
     *      tags={"RolApk"},
     *      description="Update RolApk",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RolApk",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RolApk that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RolApk")
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
     *                  ref="#/definitions/RolApk"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRolApkAPIRequest $request)
    {
        $input = $request->all();

        /** @var RolApk $rolApk */
        $rolApk = $this->rolApkRepository->find($id);

        if (empty($rolApk)) {
            return $this->sendError('Rol Apk not found', 404);
        }

        $rolApk = $this->rolApkRepository->update($input, $id);

        return $this->sendResponse($rolApk->toArray(), 'RolApk updated successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/api/v1/rol_apk/roles_apks/{id}",
     *      summary="Remove the specified RolApk from storage",
     *      tags={"RolApk"},
     *      description="Delete RolApk",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RolApk",
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
        /** @var RolApk $rolApk */
        $rolApk = $this->rolApkRepository->find($id);

        if (empty($rolApk)) {
            return $this->sendError('Rol Apk not found', 404);
        }

        $rolApk->delete();

        return $this->sendSuccess('Rol Apk deleted successfully');
    }
}
