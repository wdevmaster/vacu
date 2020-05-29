<?php

namespace Modules\Usuario\Http\Controllers\Auth;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Modules\Usuario\Entities\User;
use Modules\Usuario\Repositories\UserRepository;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /** @var  Client */
    private $cliente;

    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->cliente = Client::where('password_client', 1)->first();

        $this->userRepository = $userRepo;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',

        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * * @SWG\Definition(
     *      definition="RegisterUsuarioData",
     *      required={"email", "password", "apellido_paterno", "email", "rol_id"},
     *     @SWG\Property(
     *          property="name",
     *          description="name",
     *          type="string",
     *          example="name1"
     *      ),
     *      @SWG\Property(
     *          property="email",
     *          description="email",
     *          type="string"
     *      ),
     *      @SWG\Property(
     *          property="password",
     *          description="password",
     *          type="string"
     *      ),
     *      @SWG\Property(
     *          property="password_confirmation",
     *          description="password_confirmation",
     *          type="string"
     *      ),
     *      @SWG\Property(
     *          property="negocioId",
     *          description="Negocio Id",
     *          type="integer"
     *      ),
     *      @SWG\Property(
     *          property="fincaId",
     *          description="Finca Id",
     *          type="integer"
     *      )
     * )
     *
     * @SWG\Post(
     *      path="/api/v1/usuario/auth/register",
     *      summary="Registra un nuevo usuario.",
     *      tags={"Auth"},
     *      description="Registra un nuevo usuarion.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Datos del usuario que va a ser registrado.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/RegisterUsuarioData")
     *      ),
     *      @SWG\Response(
     *          response=201,
     *          description="Operacion exitosa",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="token_type",
     *                  type="string",
     *                  example="Bearer"
     *              ),
     *              @SWG\Property(
     *                  property="expires_in",
     *                  type="integer",
     *              ),
     *              @SWG\Property(
     *                  property="access_token",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="refresh_token",
     *                  type="string"
     *              )
     *          )
     *      ),
     *      @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *      ),
     *      @SWG\Response(
     *         response=422,
     *         description="Validation Errors",
     *      )
     * )
     */
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name'     => 'required|string',
                'email'    => 'required|string|email|unique:users',
                'password' => 'required|string|confirmed',
            ]);
            $user = new User([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
            ]);
            $user->save();
            return response()->json([
                'message' => 'Successfully created user!'], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => __('comun::msgs.msg_error_contact_the_administrator'),
                'success' => false
            ], 500);
        }
    }
}
