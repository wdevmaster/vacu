<?php
/**
 * Created by IntelliJ IDEA.
 * User: roli
 * Date: 2/10/20
 * Time: 13:21
 */

namespace Modules\Usuario\Http\Controllers\Auth;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Usuario\Dtos\UserDto;
use Modules\Usuario\Repositories\UserRepository;

class UserAuthAPIController extends CommonController
{

    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }


    /**
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/auth/user",
     *      summary="Display the specified User",
     *      tags={"Auth"},
     *      description="Get User Auth",
     *      produces={"application/json"},
     *
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
     *                  ref="#/definitions/UserDto"
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
    public function showAuthUser()
    {
        try{
          $user = Auth::user();
          $userDto=new UserDto($user);

            return $this->sendResponse($userDto,
                'comun::msgs.la_model_retrieved_successfully',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                false,
                500);
        }
    }
}
