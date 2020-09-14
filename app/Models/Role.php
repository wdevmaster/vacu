<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 16/06/20
 * Time: 16:58
 */

namespace App\Models;


use Modules\Usuario\Entities\RolBoton;
use Modules\Usuario\Entities\RolHasRolBoton;

class Role extends \Spatie\Permission\Models\Role
{
    protected $guard_name = 'web';


    public function getRolesBotones($id)
    {
        $roles_botones = [];

        $role_has_role_botones = RolHasRolBoton::all()->where('rol_id', '=', $id);

        if (count($role_has_role_botones) > 0) {
            foreach ($role_has_role_botones as $role_has_role_botone) {
                $roles_botones[] = RolBoton::find($role_has_role_botone->id);
            }

        }
        return $roles_botones;
    }
}
