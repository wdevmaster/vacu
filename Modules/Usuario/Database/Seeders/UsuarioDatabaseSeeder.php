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

        $users = factory(User::class, 11)->create();
    }
}
