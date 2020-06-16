<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 13/06/20
 * Time: 16:00
 */

namespace Modules\Usuario\Dtos;


use Modules\Usuario\Entities\User;
/**
 * @SWG\Definition(
 *      definition="UserDto",
 *      required={"user", "roles"},
 *      @SWG\Property(
 *          property="user",
 *          description="user",
 *          ref="#/definitions/User"
 *      ),
 *     @SWG\Property(
 *          property="roles",
 *          type="array",
 *          @SWG\Items(
 *           @SWG\Property(
 *                  property="name",
 *                  type="string"
 *              )
 *         )
 *      ),
 *     @SWG\Property(
 *          property="permisos",
 *          type="array",
 *          @SWG\Items(
 *           @SWG\Property(
 *                  property="name",
 *                  type="string"
 *              )
 *         )
 *      ),
 * )
 */
class UserDto
{
    public $user;
    public $roles;
    public $permisos;

    /**
     * UserDto constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->roles = $user->roles()->pluck('name');
        $this->permisos = $user->getAllPermissions();
    }


}
