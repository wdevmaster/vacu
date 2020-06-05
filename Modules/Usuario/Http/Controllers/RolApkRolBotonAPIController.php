<?php

namespace Modules\Usuario\Http\Controllers;

use Modules\Usuario\Http\Requests\CreateRolApkRolBotonAPIRequest;
use Modules\Usuario\Http\Requests\UpdateRolApkRolBotonAPIRequest;
use Modules\Usuario\Entities\RolApkRolBoton;
use Modules\Usuario\Repositories\RolApkRolBotonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RolApkRolBotonController
 * @package Modules\Usuario\Http\Controllers
 */

class RolApkRolBotonAPIController extends AppBaseController
{
    /** @var  RolApkRolBotonRepository */
    private $rolApkRolBotonRepository;

    public function __construct(RolApkRolBotonRepository $rolApkRolBotonRepo)
    {
        $this->rolApkRolBotonRepository = $rolApkRolBotonRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/api/v1/rol_apk_rol_boton/roles_apks_roles_botones",
     *      summary="Get a listing of the RolApkRolBotons.",
     *      tags={"RolApkRolBoton"},
     *      description="Get all RolApkRolBotons",
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
     *                  @SWG\Items(ref="#/definitions/RolApkRolBoton")
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
        $rolApkRolBotons = $this->rolApkRolBotonRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($rolApkRolBotons->toArray(), 'Rol Apk Rol Botons retrieved successfully');
    }

    /**
     * @param CreateRolApkRolBotonAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/api/v1/rol_apk_rol_boton/roles_apks_roles_botones",
     *      summary="Store a newly created RolApkRolBoton in storage",
     *      tags={"RolApkRolBoton"},
     *      description="Store RolApkRolBoton",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RolApkRolBoton that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RolApkRolBoton")
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
     *                  ref="#/definitions/RolApkRolBoton"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRolApkRolBotonAPIRequest $request)
    {
        $input = $request->all();

        $rolApkRolBoton = $this->rolApkRolBotonRepository->create($input);

        return $this->sendResponse($rolApkRolBoton->toArray(), 'Rol Apk Rol Boton saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/api/v1/rol_apk_rol_boton/roles_apks_roles_botones/{id}",
     *      summary="Display the specified RolApkRolBoton",
     *      tags={"RolApkRolBoton"},
     *      description="Get RolApkRolBoton",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RolApkRolBoton",
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
     *                  ref="#/definitions/RolApkRolBoton"
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
        /** @var RolApkRolBoton $rolApkRolBoton */
        $rolApkRolBoton = $this->rolApkRolBotonRepository->find($id);

        if (empty($rolApkRolBoton)) {
            return $this->sendError('Rol Apk Rol Boton not found');
        }

        return $this->sendResponse($rolApkRolBoton->toArray(), 'Rol Apk Rol Boton retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRolApkRolBotonAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/api/v1/rol_apk_rol_boton/roles_apks_roles_botones/{id}",
     *      summary="Update the specified RolApkRolBoton in storage",
     *      tags={"RolApkRolBoton"},
     *      description="Update RolApkRolBoton",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RolApkRolBoton",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RolApkRolBoton that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RolApkRolBoton")
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
     *                  ref="#/definitions/RolApkRolBoton"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRolApkRolBotonAPIRequest $request)
    {
        $input = $request->all();

        /** @var RolApkRolBoton $rolApkRolBoton */
        $rolApkRolBoton = $this->rolApkRolBotonRepository->find($id);

        if (empty($rolApkRolBoton)) {
            return $this->sendError('Rol Apk Rol Boton not found');
        }

        $rolApkRolBoton = $this->rolApkRolBotonRepository->update($input, $id);

        return $this->sendResponse($rolApkRolBoton->toArray(), 'RolApkRolBoton updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/api/v1/rol_apk_rol_boton/roles_apks_roles_botones/{id}",
     *      summary="Remove the specified RolApkRolBoton from storage",
     *      tags={"RolApkRolBoton"},
     *      description="Delete RolApkRolBoton",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RolApkRolBoton",
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
        /** @var RolApkRolBoton $rolApkRolBoton */
        $rolApkRolBoton = $this->rolApkRolBotonRepository->find($id);

        if (empty($rolApkRolBoton)) {
            return $this->sendError('Rol Apk Rol Boton not found');
        }

        $rolApkRolBoton->delete();

        return $this->sendSuccess('Rol Apk Rol Boton deleted successfully');
    }
}
