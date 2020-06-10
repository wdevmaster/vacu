<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Usuario\Entities\UserApi;
use Modules\Usuario\Http\Requests\CreateUserApiAPIRequest;
use Modules\Usuario\Http\Requests\UpdateUserApiAPIRequest;
use Modules\Usuario\Repositories\UserApiRepository;
use Modules\Usuario\Repositories\UserRepository;


/**
 * Class UserApiController
 * @package Modules\Usuario\Http\Controllers
 */
class UserApiAPIController extends CommonController
{
    /** @var  UserApiRepository */
    private $userApiRepository;

    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo, UserApiRepository $userApiRepo)
    {
        $this->userApiRepository = $userApiRepo;
        $this->userRepository = $userRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/user_api/users_apis",
     *      summary="Get a listing of the UserApis.",
     *      tags={"UserApi"},
     *      description="Get all UserApis",
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
     *                  @SWG\Items(ref="#/definitions/UserApi")
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
        $paginate = isset($request->paginado) ? $request->paginado : null;

        if ($paginate) {
            $userApis = $this->userApiRepository->paginate($paginate);
        } else {
            $userApis = $this->userApiRepository->all(
                $request->except(['skip', 'limit']),
                $request->get('skip'),
                $request->get('limit')
            );
        }


        return $this->sendResponse($userApis->toArray(), 'User Apis retrieved successfully');
    }

    /**
     * @param CreateUserApiAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/user_api/users_apis",
     *      summary="Store a newly created UserApi in storage",
     *      tags={"UserApi"},
     *      description="Store UserApi",
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
     *                  ref="#/definitions/UserApi"
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
    public function store(CreateUserApiAPIRequest $request)
    {
        $input = $request->all();
        $user = $this->userRepository->create($input);
        $user_id = $user->id;
        $data = ['user_id' => $user_id];
        $userApi = $this->userApiRepository->create($data);

        return $this->sendResponse($userApi->toArray(), 'User Api saved successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/user_api/users_apis/{id}",
     *      summary="Display the specified UserApi",
     *      tags={"UserApi"},
     *      description="Get UserApi",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UserApi",
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
     *                  ref="#/definitions/UserApi"
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
    public function show($id)
    {
        /** @var UserApi $userApi */
        $userApi = $this->userApiRepository->find($id);

        if (empty($userApi)) {
            return $this->sendError('User Api not found', 404);
        }

        return $this->sendResponse($userApi->toArray(), 'User Api retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUserApiAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/user_api/users_apis/{id}",
     *      summary="Update the specified UserApi in storage",
     *      tags={"UserApi"},
     *      description="Update UserApi",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UserApi",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UserApi that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UserApi")
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
     *                  ref="#/definitions/UserApi"
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
    public function update($id, UpdateUserApiAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserApi $userApi */
        $userApi = $this->userApiRepository->find($id);

        if (empty($userApi)) {
            return $this->sendError('User Api not found', 404);
        }

        $userApi = $this->userApiRepository->update($input, $id);

        return $this->sendResponse($userApi->toArray(), 'UserApi updated successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/api/v1/user_api/users_apis/{id}",
     *      summary="Remove the specified UserApi from storage",
     *      tags={"UserApi"},
     *      description="Delete UserApi",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UserApi",
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
        /** @var UserApi $userApi */
        $userApi = $this->userApiRepository->find($id);

        if (empty($userApi)) {
            return $this->sendError('User Api not found', 404);
        }

        $userApi->delete();

        return $this->sendSuccess('User Api deleted successfully');
    }
}
