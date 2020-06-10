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
        Permission::create(['name' => 'animales.update']);
        Permission::create(['name' => 'animales.create']);
        Permission::create(['name' => 'animales.destroy']);
        Permission::create(['name' => 'animales.show']);

        Permission::create(['name' => 'clientes.index']);
        Permission::create(['name' => 'clientes.update']);
        Permission::create(['name' => 'clientes.create']);
        Permission::create(['name' => 'clientes.destroy']);
        Permission::create(['name' => 'clientes.show']);

        Permission::create(['name' => 'condiciones_corporales.index']);
        Permission::create(['name' => 'condiciones_corporales.update']);
        Permission::create(['name' => 'condiciones_corporales.create']);
        Permission::create(['name' => 'condiciones_corporales.destroy']);
        Permission::create(['name' => 'condiciones_corporales.show']);


        Permission::create(['name' => 'configuraciones.index']);
        Permission::create(['name' => 'configuraciones.update']);
        Permission::create(['name' => 'configuraciones.create']);
        Permission::create(['name' => 'configuraciones.destroy']);
        Permission::create(['name' => 'configuraciones.show']);

        Permission::create(['name' => 'enfermedades.index']);
        Permission::create(['name' => 'enfermedades.update']);
        Permission::create(['name' => 'enfermedades.create']);
        Permission::create(['name' => 'enfermedades.destroy']);
        Permission::create(['name' => 'enfermedades.show']);

        Permission::create(['name' => 'estados_fisicos.index']);
        Permission::create(['name' => 'estados_fisicos.update']);
        Permission::create(['name' => 'estados_fisicos.create']);
        Permission::create(['name' => 'estados_fisicos.destroy']);
        Permission::create(['name' => 'estados_fisicos.show']);

        Permission::create(['name' => 'eventos.index']);
        Permission::create(['name' => 'eventos.update']);
        Permission::create(['name' => 'eventos.create']);
        Permission::create(['name' => 'eventos.destroy']);
        Permission::create(['name' => 'eventos.show']);

        Permission::create(['name' => 'fincas.index']);
        Permission::create(['name' => 'fincas.update']);
        Permission::create(['name' => 'fincas.create']);
        Permission::create(['name' => 'fincas.destroy']);
        Permission::create(['name' => 'fincas.show']);

        Permission::create(['name' => 'ingresos.index']);
        Permission::create(['name' => 'ingresos.update']);
        Permission::create(['name' => 'ingresos.create']);
        Permission::create(['name' => 'ingresos.destroy']);
        Permission::create(['name' => 'ingresos.show']);

        Permission::create(['name' => 'inseminadores.index']);
        Permission::create(['name' => 'inseminadores.update']);
        Permission::create(['name' => 'inseminadores.create']);
        Permission::create(['name' => 'inseminadores.destroy']);
        Permission::create(['name' => 'inseminadores.show']);

        Permission::create(['name' => 'lactancias.index']);
        Permission::create(['name' => 'lactancias.update']);
        Permission::create(['name' => 'lactancias.create']);
        Permission::create(['name' => 'lactancias.destroy']);
        Permission::create(['name' => 'lactancias.show']);

        Permission::create(['name' => 'locomociones.index']);
        Permission::create(['name' => 'locomociones.update']);
        Permission::create(['name' => 'locomociones.create']);
        Permission::create(['name' => 'locomociones.destroy']);
        Permission::create(['name' => 'locomociones.show']);

        Permission::create(['name' => 'lotes.index']);
        Permission::create(['name' => 'lotes.update']);
        Permission::create(['name' => 'lotes.create']);
        Permission::create(['name' => 'lotes.destroy']);
        Permission::create(['name' => 'lotes.show']);

        Permission::create(['name' => 'muertes.index']);
        Permission::create(['name' => 'muertes.update']);
        Permission::create(['name' => 'muertes.create']);
        Permission::create(['name' => 'muertes.destroy']);
        Permission::create(['name' => 'muertes.show']);

        Permission::create(['name' => 'negocios.index']);
        Permission::create(['name' => 'negocios.update']);
        Permission::create(['name' => 'negocios.create']);
        Permission::create(['name' => 'negocios.destroy']);
        Permission::create(['name' => 'negocios.show']);

        Permission::create(['name' => 'partos.index']);
        Permission::create(['name' => 'partos.update']);
        Permission::create(['name' => 'partos.create']);
        Permission::create(['name' => 'partos.destroy']);
        Permission::create(['name' => 'partos.show']);

        Permission::create(['name' => 'producciones.index']);
        Permission::create(['name' => 'producciones.update']);
        Permission::create(['name' => 'producciones.create']);
        Permission::create(['name' => 'producciones.destroy']);
        Permission::create(['name' => 'producciones.show']);

        Permission::create(['name' => 'razas.index']);
        Permission::create(['name' => 'razas.update']);
        Permission::create(['name' => 'razas.create']);
        Permission::create(['name' => 'razas.destroy']);
        Permission::create(['name' => 'razas.show']);

        Permission::create(['name' => 'registros_enfermedades.index']);
        Permission::create(['name' => 'registros_enfermedades.update']);
        Permission::create(['name' => 'registros_enfermedades.create']);
        Permission::create(['name' => 'registros_enfermedades.destroy']);
        Permission::create(['name' => 'registros_enfermedades.show']);

        Permission::create(['name' => 'semens.index']);
        Permission::create(['name' => 'semens.update']);
        Permission::create(['name' => 'semens.create']);
        Permission::create(['name' => 'semens.destroy']);
        Permission::create(['name' => 'semens.show']);

        Permission::create(['name' => 'servicios.index']);
        Permission::create(['name' => 'servicios.update']);
        Permission::create(['name' => 'servicios.create']);
        Permission::create(['name' => 'servicios.destroy']);
        Permission::create(['name' => 'servicios.show']);

        Permission::create(['name' => 'configuracion.store']);
        Permission::create(['name' => 'sync.data']);


        Permission::create(['name' => 'tipos_servicios.index']);
        Permission::create(['name' => 'tipos_servicios.update']);
        Permission::create(['name' => 'tipos_servicios.create']);
        Permission::create(['name' => 'tipos_servicios.destroy']);
        Permission::create(['name' => 'tipos_servicios.show']);

        Permission::create(['name' => 'usuarios.index']);
        Permission::create(['name' => 'usuarios.update']);
        Permission::create(['name' => 'usuarios.create']);
        Permission::create(['name' => 'usuarios.destroy']);
        Permission::create(['name' => 'usuarios.show']);
        Permission::create(['name' => 'usuarios.assign.role']);

        Permission::create(['name' => 'clientes_negocios.index']);
        Permission::create(['name' => 'clientes_negocios.update']);
        Permission::create(['name' => 'clientes_negocios.create']);
        Permission::create(['name' => 'clientes_negocios.destroy']);
        Permission::create(['name' => 'clientes_negocios.show']);

        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.update']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.destroy']);
        Permission::create(['name' => 'roles.show']);
        Permission::create(['name' => 'roles.give_permission']);

        Permission::create(['name' => 'permisos.index']);
        Permission::create(['name' => 'permisos.update']);
        Permission::create(['name' => 'permisos.create']);
        Permission::create(['name' => 'permisos.destroy']);
        Permission::create(['name' => 'permisos.show']);

        Permission::create(['name' => 'roles_botones.index']);
        Permission::create(['name' => 'roles_botones.update']);
        Permission::create(['name' => 'roles_botones.create']);
        Permission::create(['name' => 'roles_botones.destroy']);
        Permission::create(['name' => 'roles_botones.show']);


        Permission::create(['name' => 'ventas.index']);
        Permission::create(['name' => 'ventas.update']);
        Permission::create(['name' => 'ventas.create']);
        Permission::create(['name' => 'ventas.destroy']);
        Permission::create(['name' => 'ventas.show']);

        Permission::create(['name' => 'users_apks.index']);
        Permission::create(['name' => 'users_apks.update']);
        Permission::create(['name' => 'users_apks.create']);
        Permission::create(['name' => 'users_apks.destroy']);
        Permission::create(['name' => 'users_apks.show']);
        Permission::create(['name' => 'users_apks.give_role_apk']);


        Permission::create(['name' => 'users_apis.index']);
        Permission::create(['name' => 'users_apis.update']);
        Permission::create(['name' => 'users_apis.create']);
        Permission::create(['name' => 'users_apis.destroy']);
        Permission::create(['name' => 'users_apis.show']);

        Permission::create(['name' => 'roles_apks.index']);
        Permission::create(['name' => 'roles_apks.update']);
        Permission::create(['name' => 'roles_apks.create']);
        Permission::create(['name' => 'roles_apks.destroy']);
        Permission::create(['name' => 'roles_apks.show']);
        Permission::create(['name' => 'roles_apks.give_role_boton']);


        Permission::create(['name' => 'roles_apks_roles_botones.index']);
        Permission::create(['name' => 'roles_apks_roles_botones.update']);
        Permission::create(['name' => 'roles_apks_roles_botones.create']);
        Permission::create(['name' => 'roles_apks_roles_botones.destroy']);
        Permission::create(['name' => 'roles_apks_roles_botones.show']);

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
