<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 13/06/20
 * Time: 16:53
 */

namespace Modules\Usuario\Dtos;


use Spatie\Permission\Models\Role;

class RolDto
{
public $rol;
public $permisos;
    /**
     * RolDto constructor.
     */
    public function __construct(Role $role)
    {
        $this->rol = $role;
        $this->permisos = $role->permissions;
    }
}
