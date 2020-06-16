<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Usuario\Dtos\UserDto;
use Modules\Usuario\Entities\User;
use Modules\Usuario\Http\Requests\CreateUserAPIRequest;
use Modules\Usuario\Http\Requests\UpdateUserAPIRequest;
use Modules\Usuario\Repositories\UserRepository;
use Spatie\Permission\Models\Role;

/**
 * Class UserController
 * @package Modules\Usuario\Http\Controllers
 */
class UserAPIController extends CommonController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/usuario/usuarios",
     *      summary="Get a listing of the Users.",
     *      tags={"User"},
     *      description="Get all Users",
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
     *                  @SWG\Items(ref="#/definitions/UserDto")
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
                $users = $this->userRepository->paginate($paginate);
            } else {
                $users = $this->userRepository->all(
                    $request->except(['skip', 'limit']),
                    $request->get('skip'),
                    $request->get('limit')
                );
            }

            for ($i = 0; $i < count($users); $i++){
                $users[$i] = new UserDto($users[$i]);
            }

            return response()->json([
                'message' => __('comun::msgs.la_model_updated_successfully', [
                    'model' => trans_choice('usuario::msgs.label_usuario', 1)
                ]),
                'success' => true,
                'data' => $users
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => __('comun::msgs.la_model_not_found', [
                    'model' => trans_choice('usuario::msgs.label_usuario', 1)
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
     * @param CreateUserAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/usuario/usuarios",
     *      summary="Store a newly created User in storage",
     *      tags={"User"},
     *      description="Store User",
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
     *                  ref="#/definitions/User"
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
    public function store(CreateUserAPIRequest $request)
    {
        try {
            $input = $request->all();

            $user = $this->userRepository->create($input);

            return response()->json([
                'message' => __('comun::msgs.la_model_saved_successfully', [
                    'model' => trans_choice('usuario::msgs.label_usuario', 1)
                ]),
                'success' => true,
                'data' => $user
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => __('comun::msgs.la_model_not_found', [
                    'model' => trans_choice('usuario::msgs.label_usuario', 1)
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
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/usuario/usuarios/filter/all",
     * *      summary="Obtiene los datos de los usuarios , filtrados y paginados.",
     *      tags={"User"},
     *      description="Obtiene los datos de los usuarios , filtrados y paginados.",
     *      produces={"application/json"},
     *     @SWG\Parameter(
     *          name="paginado",
     *          in="query",
     *          type="integer",
     *          description="Numero de items en cada pagina.",
     *          default="10",
     *      ),
     *      @SWG\Parameter(
     *          name="ordenado_por",
     *          in="query",
     *          type="string",
     *          description="Campo por el que vamos a ordenar.",
     *          default="created_at"
     *      ),
     *      @SWG\Parameter(
     *          name="direccion",
     *          in="query",
     *          type="string",
     *          description="Direccion en la que vamos a ordenar. Posibles valores (DESC o ASC)",
     *          default="ASC"
     *       ),
     *      @SWG\Parameter(
     *          name="filter",
     *          in="query",
     *          type="array",
     *          description="Cada elemento del arreglo filter debe estar en el formato: [['<b>campo</b>','<b>operador</b>','<b>valor</b>']]. <br><br>
    <b>campo</b>(string): uno de los siguientes valores ('<b>negocio_id</b>'). Id del negocio a filtrar <br>
    <b>operador</b>(string): Los posibles operadores son: '=', '!=', 'like',  '>', '<'. <br>
    <b>valor</b>: El valor que se usara en la busqueda. <br><br><b>ej</b>: [[''negocio_id'',''='',''1'']] <br><br>
    <b>Nota: Cuando se envia el operador like en el filter el valor no debe contener los signos de ''%''.</b>",
     *          @SWG\Items(
     *              type="array",
     *              @SWG\Items(
     *                  @SWG\Property(
     *                       property="campo",
     *                       description="Campo para agregar al criterio de busqueda. Uno de los siguientes valores ('<b>negocio_id</b>').",
     *                       type="string"
     *                  ),
     *                  @SWG\Property(
     *                       property="operador",
     *                       description="Los posibles operadores son: '=', '!=', 'like',  '>', '<'.",
     *                       type="string",
     *                       example="'='",
     *                  ),
     *                  @SWG\Property(
     *                       property="valor",
     *                       description="Valor para comparar en la busqueda.",
     *                       type="string"
     *                  )
     *              )
     *          )
     *       ),
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
     *                  @SWG\Items(ref="#/definitions/User")
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
    public function filter(Request $request)
    {
        try {

            $filter = $request->filter ? json_decode($request->filter) : [];
            $orderBy = $request->ordenado_por ? $request->ordenado_por : 'created_at';
            $direction = $request->direccion ? $request->direccion : 'ASC';
            $paginate = 10;

            if (!empty($request['paginado']) && $request['paginado'] != null)
                $paginate = $request['paginado'];


            $paginados = $this->userRepository->filterByNegocioId($filter, $orderBy, $direction, $paginate);
            $results = [];

            foreach ($paginados->items() as $user) {
                $results [] = $user;
            }

            return response()->json([
                'message' => __('comun::msgs.la_model_show_successfully', [
                    'model' => trans_choice('usuario::msgs.label_usuario', 1)
                ]),
                'success' => true,
                'data' => $results
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => __('comun::msgs.la_model_not_found', [
                    'model' => trans_choice('usuario::msgs.label_usuario', 1)
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
     * @param int $id
     * @param UpdateUserAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/usuario/usuarios/{id}",
     *      summary="Update the specified User in storage",
     *      tags={"User"},
     *      description="Update User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of User",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="User that should be updated",
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
     *                  ref="#/definitions/User"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *      security={
     *       {"Bearer": {}}
     *      }
     * )
     */
    public function update($id, UpdateUserAPIRequest $request)
    {
        try {
            $input = $request->all();


            $user = $this->userRepository->update($input, $id);

            return response()->json([
                'message' => __('comun::msgs.la_model_updated_successfully', [
                    'model' => trans_choice('usuario::msgs.label_usuario', 1)
                ]),
                'success' => true,
                'data' => $user
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => __('comun::msgs.la_model_not_found', [
                    'model' => trans_choice('usuario::msgs.label_usuario', 1)
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
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Delete(
     *      path="/api/v1/usuario/usuarios/{id}",
     *      summary="Remove the specified User from storage",
     *      tags={"User"},
     *      description="Delete User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of User",
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
     * @throws \Exception
     */
    public function destroy($id)
    {
        try {
            /** @var User $user */
            $user = $this->userRepository->find($id);

            $user->delete();

            return response()->json([
                'message' => __('comun::msgs.la_model_deleted_successfully', [
                    'model' => trans_choice('usuario::msgs.label_usuario', 1)
                ]),
                'success' => true,
                'data' => $user
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => __('comun::msgs.la_model_not_found', [
                    'model' => trans_choice('usuario::msgs.label_usuario', 1)
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
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/usuario/usuarios/{id}/assign/role",
     *      summary="Remove the specified User from storage",
     *      tags={"User"},
     *      description="Delete User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of User",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="User that should be updated",
     *          required=false,
     *          @SWG\Schema(
     *              @SWG\Property(
     *                  property="role_id",
     *                  description="Role Id",
     *                  type="integer"
     *              ),
     *
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
     *
     */
    public function assignRoleTo($id, Request $request)
    {
        try {
            $input = $request->all();
            $role_id = $input['role_id'];
            /**
             * @var Role $role
             */
            $role = Role::find($role_id);
            if (!$role)
                return $this->sendError('Role not Found', 404);

            /**
             * @var User $user
             */
            $user = User::find($id);

            if (!$user)
                return $this->sendError('User not found', 404);

            $user->assignRole($role->name);

            return $this->sendSuccess('Role assigned successfully');
        } catch (\Exception $e) {
            return $this->sendError('Error contact the administrator', 500);
        }
    }
}
