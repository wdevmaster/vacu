<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 16/06/20
 * Time: 16:58
 */

namespace App\Models;


class Role extends \Spatie\Permission\Models\Role
{
    protected $guard_name = 'web';
}
