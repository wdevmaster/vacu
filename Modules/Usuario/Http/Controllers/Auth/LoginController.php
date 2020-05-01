<?php

namespace Modules\Usuario\Http\Controllers\Auth;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Client;
use Modules\Usuario\Entities\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /** @var  Client */
    private $cliente;

    public function __construct()
    {
        $this->cliente = Client::where('password_client', 1)->first();
    }

    protected function guard()
    {
        return Auth::guard('api');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/usuario/auth/login",
     *      summary="Login para usuarios",
     *      tags={"Auth"},
     *      description="Login para usuarios",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Request with authentication data",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              required={"email", "password"},
     *              @SWG\Property(
     *                  property="email",
     *                  description="User email",
     *                  type="string",
     *                  example="user@gmail.com"
     *              ),
     *              @SWG\Property(
     *                  property="password",
     *                  description="User password",
     *                  type="string",
     *                  example="password"
     *              )
     *          )
     *      ),
     *      @SWG\Response(
     *          response=200,
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
     *     @SWG\Response(
     *         response=422,
     *         description="Validation errors"
     *     )
     * )
     */
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()], 422);
        }

        try {
            $user = User::all()->where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'errors' => [
                        [__('comun::msgs.login_error')]
                    ]
                ], 422);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'errors' => [
                        [__('comun::msgs.login_password_error')]
                    ]
                ], 422);
            }

            if (!$user->activacion) {
                return response()->json([
                    'errors' => [
                        [__('usuario::msgs.msg_user_block')]
                    ]
                ], 422);
            }

            $request->request->add([
                'grant_type' => 'password',
                'client_id' => $this->cliente->id,
                'client_secret' => $this->cliente->secret,
                'username' => $request['email'],
                'password' => $request['password'],
                'provider' => 'api',
            ]);

            // Fire off the internal request.
            $proxy = Request::create(
                'oauth/token',
                'POST'
            );

            return Route::dispatch($proxy);
        } catch (Exception $e) {
            return response()->json([
                'message' => __('comun::msgs.msg_error_contact_the_administrator'),
                'success' => false
            ], 500);
        }
    }
}
