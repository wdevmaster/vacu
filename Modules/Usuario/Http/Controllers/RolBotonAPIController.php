<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Usuario\Http\Requests\CreateRolBotonAPIRequest;
use Modules\Usuario\Http\Requests\UpdateRolBotonAPIRequest;
use Modules\Usuario\Entities\RolBoton;
use Modules\Usuario\Repositories\RolBotonRepository;
use Illuminate\Http\Request;


/**
 * Class RolBotonController
 * @package Modules\Usuario\Http\Controllers
 */

class RolBotonAPIController extends CommonController
{
    /** @var  RolBotonRepository */
    private $rolBotonRepository;

    public function __construct(RolBotonRepository $rolBotonRepo)
    {
        $this->rolBotonRepository = $rolBotonRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/rol_boton/roles_botones",
     *      summary="Get a listing of the RolBotons.",
     *      tags={"RolBoton"},
     *      description="Get all RolBotons",
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
     *                  @SWG\Items(ref="#/definitions/RolBoton")
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
        $rolBotons = $this->rolBotonRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($rolBotons->toArray(), 'Rol Botons retrieved successfully');
    }

    /**
     * @param CreateRolBotonAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/rol_boton/roles_botones",
     *      summary="Store a newly created RolBoton in storage",
     *      tags={"RolBoton"},
     *      description="Store RolBoton",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RolBoton that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RolBoton")
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
     *                  ref="#/definitions/RolBoton"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRolBotonAPIRequest $request)
    {
        $input = $request->all();

        $rolBoton = $this->rolBotonRepository->create($input);

        return $this->sendResponse($rolBoton->toArray(), 'Rol Boton saved successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/rol_boton/roles_botones/{id}",
     *      summary="Display the specified RolBoton",
     *      tags={"RolBoton"},
     *      description="Get RolBoton",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RolBoton",
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
     *                  ref="#/definitions/RolBoton"
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
        /** @var RolBoton $rolBoton */
        $rolBoton = $this->rolBotonRepository->find($id);

        if (empty($rolBoton)) {
            return $this->sendError('Rol Boton not found', 404);
        }

        return $this->sendResponse($rolBoton->toArray(), 'Rol Boton retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRolBotonAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/rol_boton/roles_botones/{id}",
     *      summary="Update the specified RolBoton in storage",
     *      tags={"RolBoton"},
     *      description="Update RolBoton",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RolBoton",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="RolBoton that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RolBoton")
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
     *                  ref="#/definitions/RolBoton"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRolBotonAPIRequest $request)
    {
        $input = $request->all();

        /** @var RolBoton $rolBoton */
        $rolBoton = $this->rolBotonRepository->find($id);

        if (empty($rolBoton)) {
            return $this->sendError('Rol Boton not found', 404);
        }

        $rolBoton = $this->rolBotonRepository->update($input, $id);

        return $this->sendResponse($rolBoton->toArray(), 'RolBoton updated successfully');
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/api/v1/rol_boton/roles_botones/{id}",
     *      summary="Remove the specified RolBoton from storage",
     *      tags={"RolBoton"},
     *      description="Delete RolBoton",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of RolBoton",
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
        /** @var RolBoton $rolBoton */
        $rolBoton = $this->rolBotonRepository->find($id);

        if (empty($rolBoton)) {
            return $this->sendError('Rol Boton not found', 404);
        }

        $rolBoton->delete();

        return $this->sendSuccess('Rol Boton deleted successfully');
    }
}
