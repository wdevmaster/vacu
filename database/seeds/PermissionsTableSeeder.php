<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 29/05/20
 * Time: 10:52
 */


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Modules\Usuario\Entities\User;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Permission list
        Permission::create(['name' => 'negocios.index']);
        Permission::create(['name' => 'negocios.edit']);
        Permission::create(['name' => 'negocios.create']);
        Permission::create(['name' => 'negocios.destroy']);


        Permission::create(['name' => 'usuarios.index']);
        Permission::create(['name' => 'usuarios.edit']);
        Permission::create(['name' => 'usuarios.create']);
        Permission::create(['name' => 'usuarios.destroy']);



        //Admin
        $admin = Role::create(['name' => 'SuperAdmin']);

//        $admin->givePermissionTo([
//            'products.index',
//            'products.edit',
//            'products.show',
//            'products.create',
//            'products.destroy'
//        ]);
        //$admin->givePermissionTo('products.index');
        $admin->givePermissionTo(Permission::all());


        //User Admin
        $user = User::where('email', 'admin@admin.com')->first();
        $user->assignRole('SuperAdmin');
    }
}
