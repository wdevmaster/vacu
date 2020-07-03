<?php

namespace Modules\Usuario\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Usuario\Entities\User;

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




    }
}
