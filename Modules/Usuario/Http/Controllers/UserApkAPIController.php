<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Usuario\Entities\UserApk;
use Modules\Usuario\Http\Requests\CreateUserApkAPIRequest;
use Modules\Usuario\Http\Requests\UpdateUserApkAPIRequest;
use Modules\Usuario\Repositories\RolApkRepository;
use Modules\Usuario\Repositories\UserApkRepository;
use Modules\Usuario\Repositories\UserRepository;

/**
 * Class UserApkController
 * @package Modules\Usuario\Http\Controllers
 */
class UserApkAPIController extends CommonController
{
    /** @var  UserApkRepository */
    private $userApkRepository;

    /** @var  UserRepository */
    private $userRepository;


    private $rolApkRepository;


    public function __construct(UserRepository $userRepo, UserApkRepository $userApkRepo, RolApkRepository $rolApkRepo)
    {
        $this->userApkRepository = $userApkRepo;
        $this->userRepository = $userRepo;
        $this->rolApkRepository = $rolApkRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/user_apk/users_apks",
     *      summary="Get a listing of the UserApks.",
     *      tags={"UserApk"},
     *      description="Get all UserApks",
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
     *                  @SWG\Items(ref="#/definitions/UserApk")
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

        $paginate = isset($request->paginado) ? $request->paginado : null;

        if ($paginate) {
            $userApks = $this->userApkRepository->paginate($paginate);
        } else {
            $userApks = $this->userApkRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
        }


        return $this->sendResponse($userApks->toArray(), 'User Apks retrieved successfully');
    }

    /**
     * @param CreateUserApkAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/user_apk/users_apks",
     *      summary="Store a newly created UserApk in storage",
     *      tags={"UserApk"},
     *      description="Store UserApk",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="User that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
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
     *                  ref="#/definitions/UserApk"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUserApkAPIRequest $request)
    {
        $input = $request->all();
        $user = $this->userRepository->create($input);
        $user_id = $user->id;
        $data = ['user_id' => $user_id];
        $userApk = $this->userApkRepository->create($data);
        return $this->sendResponse($userApk->toArray(), 'User Apk saved successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/user_apk/users_apks/{id}",
     *      summary="Display the specified UserApk",
     *      tags={"UserApk"},
     *      description="Get UserApk",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UserApk",
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
     *                  ref="#/definitions/UserApk"
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
        /** @var UserApk $userApk */
        $userApk = $this->userApkRepository->find($id);

        if (empty($userApk)) {
            return $this->sendError('User Apk not found', 404);
        }

        return $this->sendResponse($userApk->toArray(), 'User Apk retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUserApkAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/user_apk/users_apks/{id}",
     *      summary="Update the specified UserApk in storage",
     *      tags={"UserApk"},
     *      description="Update UserApk",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UserApk",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UserApk that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UserApk")
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
     *                  ref="#/definitions/UserApk"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUserApkAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserApk $userApk */
        $userApk = $this->userApkRepository->find($id);

        if (empty($userApk)) {
            return $this->sendError('User Apk not found', 404);
        }

        $userApk = $this->userApkRepository->update($input, $id);

        return $this->sendResponse($userApk->toArray(), 'UserApk updated successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/api/v1/user_apk/users_apks/{id}",
     *      summary="Remove the specified UserApk from storage",
     *      tags={"UserApk"},
     *      description="Delete UserApk",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UserApk",
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
        /** @var UserApk $userApk */
        $userApk = $this->userApkRepository->find($id);

        if (empty($userApk)) {
            return $this->sendError('User Apk not found', 404);
        }

        $userApk->delete();

        return $this->sendSuccess('User Apk deleted successfully');
    }



    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Post(
     *      path="/api/v1/user_apk/users_apks/{id}/give/rol_apk",
     *      summary="Asignnig RolApk to UserApk",
     *      tags={"UserApk"},
     *      description="Asigning Rol Apk",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of User Apk",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Role Apk that should be updated",
     *          required=false,
     *          @SWG\Schema(
     *           @SWG\Property(
     *                  property="giveRolApkTo",
     *                  type="array",
     *                  @SWG\Items(
     *                      @SWG\Property(
     *                          property="nombre",
     *                          type="string",
     *                          example="negocios.index"
     *                      ),
     *                  )
     *
     *
     *              ),
     *          )
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

    public function giveRolApkToUserApk($id_user_apk, Request $request)
    {
        /** @var UserApk $userApk */
        $userApk = $this->userApkRepository->find($id_user_apk);

        if (empty($userApk)) {
            return $this->sendError('User Apk not found', 404);
        }


        $input = $request->all();
        $rol_apk = $input['giveRolApkTo'];
        $rol_apk_id=$rol_apk->id;
        $rol=$this->rolApkRepository->find($rol_apk_id);
        if(empty($rol)){
            return $this->sendError('Rol Apk not found', 404);
        }

        $userApk->update(['rol_apk__id'=>$rol_apk_id]);
        $this->userApkRepository->update($userApk);



        return $this->sendSuccess('Rol Apk assigned successfully');

    }

}
