<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 13/06/20
 * Time: 16:53
 */

namespace Modules\Usuario\Dtos;


use App\Models\Role;
use Modules\Usuario\Entities\RolHasRolBoton;

class RolDto
{
public $rol;
public $permisos;
public $roles_botones;
    /**
     * RolDto constructor.
     */
    public function __construct(Role $role)
    {
        $this->rol = $role;
        $this->permisos = $role->permissions;
        $this->roles_botones = $role->getRolesBotones($role->id);
    }
}
