<?php

namespace Modules\Usuario\Http\Controllers\Auth;

use Carbon\Carbon;
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
            $request->validate([
                'email'       => 'required|string|email',
                'password'    => 'required|string',
                'remember_me' => 'boolean',
            ]);
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Unauthorized'], 401);
            }
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addWeeks(1);
            }
            $token->save();
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type'   => 'Bearer',
                'expires_at'   => Carbon::parse(
                    $tokenResult->token->expires_at)
                    ->toDateTimeString(),
            ]);

        } catch (Exception $e) {
            return response()->json([
                'message' => __('comun::msgs.msg_error_contact_the_administrator'),
                'success' => false
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>
            'Successfully logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
