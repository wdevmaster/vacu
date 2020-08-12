<?php

namespace Modules\Usuario\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Usuario\Entities\RolApk;
use Modules\Usuario\Entities\RolHasRolBoton;
use Modules\Usuario\Entities\RolBoton;
use Modules\Usuario\Entities\User;
use Modules\Usuario\Entities\UserApk;

class UsuarioDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $administradorUser = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' =>  Hash::make('777crew')
        ]);

        $apkUserTest = User::create([
            'name' => 'apk',
            'email' => 'apk@test.com',
            'password' =>  Hash::make('apktest123')
        ]);


        $andresTest = User::create([
            'name' => 'andres',
            'email' => 'andres@test.com',
            'password' =>  Hash::make('andres123')
        ]);

        $sergioTest = User::create([
            'name' => 'sergio',
            'email' => 'sergio@test.com',
            'password' =>  Hash::make('sergio123')
        ]);

        $carlosTest = User::create([
            'name' => 'carlos',
            'email' => 'carlos@test.com',
            'password' =>  Hash::make('carlos123')
        ]);

        $this->call(RolBotonesSeeder::class);

        $user1 = factory(User::class)->create([
            'name' => 'dueno',
            'email' => 'dueno@medialuna.com',
            'password' => Hash::make('dueno123*'),
            'negocio_id' => 1,

        ]);
        $user1->save();
//        $dueno = factory(UserApk::class)->create([
//            'user_id' => $user1->id
//        ]);
//
//        $rol_dueno = factory(RolApk::class)->create([
//            'nombre' => 'Dueno',
//            'descripcion' => 'Duenno de la Finca',
//        ]);
//
//        $rol_botones = RolBoton::all();
//
//        foreach ($rol_botones as $rol_botone){
//            RolHasRolBoton::create([
//                'rol_apk_id' => $rol_dueno->id,
//                'rol_boton_id' => $rol_botone->id
//            ]);
//        }
//
//        $dueno->rol_apk_id = $rol_dueno->id;
//        $dueno->save();




        $user2 = factory(User::class)->create([
            'name' => 'Vaquero Reproductor',
            'email' => 'vr@medialuna.com',
            'password' => Hash::make('vaqueroR123*'),
            'negocio_id' => 1,

        ]);
        $user2->save();
//        $vaquero_reproductor = factory(UserApk::class)->create([
//            'user_id' => $user2->id
//        ]);
//        $rol_vaquero_reproductor = factory(RolApk::class)->create([
//            'nombre' => 'Vaquero-Reproductor',
//            'descripcion' => 'Vaquero Reproductor',
//        ]);
//
//        $rol_boton_reproduccion = RolBoton::all()->where('nombre', 'btn_reproduccion')->first();
//        RolHasRolBoton::create([
//            'rol_apk_id' => $rol_vaquero_reproductor->id,
//            'rol_boton_id' => $rol_boton_reproduccion->id
//        ]);
//
//        $rol_boton_eventos = RolBoton::all()->where('nombre', 'btn_eventos')->first();
//        RolHasRolBoton::create([
//            'rol_apk_id' => $rol_vaquero_reproductor->id,
//            'rol_boton_id' => $rol_boton_eventos->id
//        ]);
//
//        $vaquero_reproductor->rol_apk_id = $rol_dueno->id;
//        $vaquero_reproductor->save();


        $user3 = factory(User::class)->create([
            'name' => 'Vaquero Administrador',
            'email' => 'va@medialuna.com',
            'password' => Hash::make('vaqueroA123*'),
            'negocio_id' => 1,

        ]);
        $user3->save();
//        $vaquero_administrador = factory(UserApk::class)->create([
//            'user_id' => $user3->id
//        ]);
//
//        $rol_vaquero_administrador = factory(RolApk::class)->create([
//            'nombre' => 'Vaquero-Administrador',
//            'descripcion' => 'Vaquero Administrador',
//        ]);
//
//        $rol_boton_inventario = RolBoton::all()->where('nombre', 'btn_inventario')->first();
//        RolHasRolBoton::create([
//            'rol_apk_id' => $rol_vaquero_administrador->id,
//            'rol_boton_id' => $rol_boton_inventario->id
//        ]);
//
//        $rol_boton_ingresofinca = RolBoton::all()->where('nombre', 'btn_ingresoafinca')->first();
//        RolHasRolBoton::create([
//            'rol_apk_id' => $rol_vaquero_administrador->id,
//            'rol_boton_id' => $rol_boton_ingresofinca->id
//        ]);
//
//        $vaquero_administrador->rol_apk_id = $rol_dueno->id;
//        $vaquero_administrador->save();
//
    }
}
