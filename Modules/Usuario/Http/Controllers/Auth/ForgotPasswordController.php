<?php

namespace Modules\Usuario\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/usuario/auth/password/email",
     *      summary="Para solicitar un cambio de contraseña del cliente.",
     *      tags={"Auth"},
     *      description="Para solicitar un cambio de contraseña del cliente",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="request",
     *          in="body",
     *          description="Correo que se utilizara para el proceso de cambio de contraseña.",
     *          required=true,
     *          @SWG\Schema(
     *              type="object",
     *              required={"email"},
     *              @SWG\Property(
     *                  property="email",
     *                  description="User email",
     *                  type="string",
     *                  example="cliente@gmail.com"
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
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json([
            'success' => true,
            'message' => __($response)
        ], 200);
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json([
            'errors' => [
                [__($response)]
            ]
        ], 422);
    }
}
