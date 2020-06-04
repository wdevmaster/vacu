<?php

namespace Modules\Usuario\Http\Controllers;

use Modules\Usuario\Http\Requests\CreateUserApkAPIRequest;
use Modules\Usuario\Http\Requests\UpdateUserApkAPIRequest;
use Modules\Usuario\Entities\UserApk;
use Modules\Usuario\Repositories\UserApkRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UserApkController
 * @package Modules\Usuario\Http\Controllers
 */

class UserApkAPIController extends AppBaseController
{
    /** @var  UserApkRepository */
    private $userApkRepository;

    public function __construct(UserApkRepository $userApkRepo)
    {
        $this->userApkRepository = $userApkRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/userApks",
     *      summary="Get a listing of the UserApks.",
     *      tags={"UserApk"},
     *      description="Get all UserApks",
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
        $userApks = $this->userApkRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($userApks->toArray(), 'User Apks retrieved successfully');
    }

    /**
     * @param CreateUserApkAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/userApks",
     *      summary="Store a newly created UserApk in storage",
     *      tags={"UserApk"},
     *      description="Store UserApk",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UserApk that should be stored",
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
    public function store(CreateUserApkAPIRequest $request)
    {
        $input = $request->all();

        $userApk = $this->userApkRepository->create($input);

        return $this->sendResponse($userApk->toArray(), 'User Apk saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/userApks/{id}",
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
            return $this->sendError('User Apk not found');
        }

        return $this->sendResponse($userApk->toArray(), 'User Apk retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUserApkAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/userApks/{id}",
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
            return $this->sendError('User Apk not found');
        }

        $userApk = $this->userApkRepository->update($input, $id);

        return $this->sendResponse($userApk->toArray(), 'UserApk updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/userApks/{id}",
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
            return $this->sendError('User Apk not found');
        }

        $userApk->delete();

        return $this->sendSuccess('User Apk deleted successfully');
    }
}
