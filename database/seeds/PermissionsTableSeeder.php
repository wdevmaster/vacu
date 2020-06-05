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

        Permission::create(['name' => 'animales.index']);
        Permission::create(['name' => 'animales.edit']);
        Permission::create(['name' => 'animales.create']);
        Permission::create(['name' => 'animales.destroy']);

        Permission::create(['name' => 'clientes.index']);
        Permission::create(['name' => 'clientes.edit']);
        Permission::create(['name' => 'clientes.create']);
        Permission::create(['name' => 'clientes.destroy']);

        Permission::create(['name' => 'condiciones_corporales.index']);
        Permission::create(['name' => 'condiciones_corporales.edit']);
        Permission::create(['name' => 'condiciones_corporales.create']);
        Permission::create(['name' => 'condiciones_corporales.destroy']);


        Permission::create(['name' => 'configuraciones.index']);
        Permission::create(['name' => 'configuraciones.edit']);
        Permission::create(['name' => 'configuraciones.create']);
        Permission::create(['name' => 'configuraciones.destroy']);

        Permission::create(['name' => 'enfermedades.index']);
        Permission::create(['name' => 'enfermedades.edit']);
        Permission::create(['name' => 'enfermedades.create']);
        Permission::create(['name' => 'enfermedades.destroy']);

        Permission::create(['name' => 'estados_fisicos.index']);
        Permission::create(['name' => 'estados_fisicos.edit']);
        Permission::create(['name' => 'estados_fisicos.create']);
        Permission::create(['name' => 'estados_fisicos.destroy']);

        Permission::create(['name' => 'eventos.index']);
        Permission::create(['name' => 'eventos.edit']);
        Permission::create(['name' => 'eventos.create']);
        Permission::create(['name' => 'eventos.destroy']);

        Permission::create(['name' => 'fincas.index']);
        Permission::create(['name' => 'fincas.edit']);
        Permission::create(['name' => 'fincas.create']);
        Permission::create(['name' => 'fincas.destroy']);

        Permission::create(['name' => 'ingresos.index']);
        Permission::create(['name' => 'ingresos.edit']);
        Permission::create(['name' => 'ingresos.create']);
        Permission::create(['name' => 'ingresos.destroy']);

        Permission::create(['name' => 'inseminadores.index']);
        Permission::create(['name' => 'inseminadores.edit']);
        Permission::create(['name' => 'inseminadores.create']);
        Permission::create(['name' => 'inseminadores.destroy']);

        Permission::create(['name' => 'lactancias.index']);
        Permission::create(['name' => 'lactancias.edit']);
        Permission::create(['name' => 'lactancias.create']);
        Permission::create(['name' => 'lactancias.destroy']);

        Permission::create(['name' => 'locomociones.index']);
        Permission::create(['name' => 'locomociones.edit']);
        Permission::create(['name' => 'locomociones.create']);
        Permission::create(['name' => 'locomociones.destroy']);

        Permission::create(['name' => 'lotes.index']);
        Permission::create(['name' => 'lotes.edit']);
        Permission::create(['name' => 'lotes.create']);
        Permission::create(['name' => 'lotes.destroy']);

        Permission::create(['name' => 'muertes.index']);
        Permission::create(['name' => 'muertes.edit']);
        Permission::create(['name' => 'muertes.create']);
        Permission::create(['name' => 'muertes.destroy']);

        Permission::create(['name' => 'negocios.index']);
        Permission::create(['name' => 'negocios.edit']);
        Permission::create(['name' => 'negocios.create']);
        Permission::create(['name' => 'negocios.destroy']);

        Permission::create(['name' => 'partos.index']);
        Permission::create(['name' => 'partos.edit']);
        Permission::create(['name' => 'partos.create']);
        Permission::create(['name' => 'partos.destroy']);

        Permission::create(['name' => 'producciones.index']);
        Permission::create(['name' => 'producciones.edit']);
        Permission::create(['name' => 'producciones.create']);
        Permission::create(['name' => 'producciones.destroy']);

        Permission::create(['name' => 'razas.index']);
        Permission::create(['name' => 'razas.edit']);
        Permission::create(['name' => 'razas.create']);
        Permission::create(['name' => 'razas.destroy']);

        Permission::create(['name' => 'registros_enfermedades.index']);
        Permission::create(['name' => 'registros_enfermedades.edit']);
        Permission::create(['name' => 'registros_enfermedades.create']);
        Permission::create(['name' => 'registros_enfermedades.destroy']);

        Permission::create(['name' => 'semens.index']);
        Permission::create(['name' => 'semens.edit']);
        Permission::create(['name' => 'semens.create']);
        Permission::create(['name' => 'semens.destroy']);

        Permission::create(['name' => 'servicios.index']);
        Permission::create(['name' => 'servicios.edit']);
        Permission::create(['name' => 'servicios.create']);
        Permission::create(['name' => 'servicios.destroy']);

        Permission::create(['name' => 'sincronizaciones.index']);
        Permission::create(['name' => 'sincronizaciones.edit']);
        Permission::create(['name' => 'sincronizaciones.create']);
        Permission::create(['name' => 'sincronizaciones.destroy']);

        Permission::create(['name' => 'tipos_servicios.index']);
        Permission::create(['name' => 'tipos_servicios.edit']);
        Permission::create(['name' => 'tipos_servicios.create']);
        Permission::create(['name' => 'tipos_servicios.destroy']);

        Permission::create(['name' => 'usuarios.index']);
        Permission::create(['name' => 'usuarios.edit']);
        Permission::create(['name' => 'usuarios.create']);
        Permission::create(['name' => 'usuarios.destroy']);

        Permission::create(['name' => 'ventas.index']);
        Permission::create(['name' => 'ventas.edit']);
        Permission::create(['name' => 'ventas.create']);
        Permission::create(['name' => 'ventas.destroy']);

        Permission::create(['name' => 'users_apks.index']);
        Permission::create(['name' => 'users_apks.edit']);
        Permission::create(['name' => 'users_apks.create']);
        Permission::create(['name' => 'users_apks.destroy']);

        Permission::create(['name' => 'users_apis.index']);
        Permission::create(['name' => 'users_apis.edit']);
        Permission::create(['name' => 'users_apis.create']);
        Permission::create(['name' => 'users_apis.destroy']);

        Permission::create(['name' => 'roles_apks.index']);
        Permission::create(['name' => 'roles_apks.edit']);
        Permission::create(['name' => 'roles_apks.create']);
        Permission::create(['name' => 'roles_apks.destroy']);

        Permission::create(['name' => 'roles_apks_roles_botones.index']);
        Permission::create(['name' => 'roles_apks_roles_botones.edit']);
        Permission::create(['name' => 'roles_apks_roles_botones.create']);
        Permission::create(['name' => 'roles_apks_roles_botones.destroy']);

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
