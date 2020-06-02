<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Usuario\Repositories\RoleRepository;
use Spatie\Permission\Models\Role;

/**
 * Class RoleController
 * @package Modules\Usuario\Http\Controllers
 */
class RoleAPIController extends CommonController
{
    /** @var  RoleRepository */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     *
     * @SWG\Definition(
     *      definition="Role",
     *      required={"name"},
     *      @SWG\Property(
     *          property="id",
     *          description="id",
     *          type="integer",
     *          format="int32"
     *      ),
     *      @SWG\Property(
     *          property="name",
     *          description="name",
     *          type="string"
     *      )
     *
     * )
     *
     *
     * @SWG\Get(
     *      path="/api/v1/role/roles",
     *      summary="Get a listing of the Roles.",
     *      tags={"Role"},
     *      description="Get all Roles",
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
     *                  @SWG\Items(ref="#/definitions/Role")
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
        $roles = $this->roleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($roles->toArray(), 'Roles retrieved successfully');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/role/roles",
     *      summary="Store a newly created Role in storage",
     *      tags={"Role"},
     *      description="Store Role",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Role that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Role")
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
     *                  ref="#/definitions/Role"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $role = $this->roleRepository->create($input);

        return $this->sendResponse($role->toArray(), 'Role saved successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/role/roles/{id}",
     *      summary="Display the specified Role",
     *      tags={"Role"},
     *      description="Get Role",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Role",
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
     *                  ref="#/definitions/Role"
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
        /** @var Role $role */
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            return $this->sendError('Role not found', 404);
        }

        return $this->sendResponse($role->toArray(), 'Role retrieved successfully');
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/role/roles/{id}",
     *      summary="Update the specified Role in storage",
     *      tags={"Role"},
     *      description="Update Role",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Role",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Role that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Role")
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
     *                  ref="#/definitions/Role"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Request $request)
    {
        $input = $request->all();

        /** @var Role $role */
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            return $this->sendError('Role not found', 404);
        }

        $role = $this->roleRepository->update($input, $id);

        return $this->sendResponse($role->toArray(), 'Role updated successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/api/v1/role/roles/{id}",
     *      summary="Remove the specified Role from storage",
     *      tags={"Role"},
     *      description="Delete Role",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Role",
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
        /** @var Role $role */
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            return $this->sendError('Role not found', 404);
        }

        $role->delete();

        return $this->sendSuccess('Role deleted successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Post(
     *      path="/api/v1/role/roles/{id}/give/permission",
     *      summary="Remove the specified Role from storage",
     *      tags={"Role"},
     *      description="Delete Role",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Role",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Role that should be updated",
     *          required=false,
     *          @SWG\Schema(
     *           @SWG\Property(
     *                  property="givePermissionTo",
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
    public function givePermissionToRole($id, Request $request)
    {
        /** @var Role $role */
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            return $this->sendError('Role not found', 404);
        }

        $input = $request->all();

       foreach ($input['givePermissionTo']  as $item){
           $role->givePermissionTo($item['nombre']);
       }

       return $this->sendSuccess('Permissions assigned successfully');

    }
}
