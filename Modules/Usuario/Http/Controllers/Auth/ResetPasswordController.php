<?php

namespace Modules\Usuario\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/usuario/auth/password/reset",
     *      summary="Para realizar el cambio de contraseña solicitado por el cliente.",
     *      tags={"Auth"},
     *      description="Para realizar el cambio de contraseña solicitado por el cliente.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Correo que se utilizara para el proceso de cambio de contraseña.",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              required={"email", "token", "password", "password_confirmation"},
     *              @SWG\Property(
     *                  property="email",
     *                  description="User email",
     *                  type="string",
     *                  example="cliente@gmail.com"
     *              ),
     *              @SWG\Property(
     *                  property="token",
     *                  description="Token recibido por correo",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="password",
     *                  description="Nueva contraseña",
     *                  type="string",
     *                  example="cliente"
     *              ),
     *              @SWG\Property(
     *                  property="password_confirmation",
     *                  description="Repetir nueva contraseña",
     *                  type="string",
     *                  example="cliente"
     *              )
     *          )
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="Operacion exitosa",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="message",
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

    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json([
            'success' => true,
            'message' => __($response)
        ], 200);
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json([
            'errors' => [
                [__($response)]
            ]
        ], 422);
    }

    /**
     * Set the user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function setUserPassword($user, $password)
    {
        $user->password = $password;
    }
}
