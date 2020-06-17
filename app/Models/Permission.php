<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 16/06/20
 * Time: 17:05
 */

namespace App\Models;


class Permission extends \Spatie\Permission\Models\Permission
{
    protected $guard_name = 'web';
}
