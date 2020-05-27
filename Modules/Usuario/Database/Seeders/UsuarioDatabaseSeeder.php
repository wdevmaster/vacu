<?php

namespace Modules\Usuario\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
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

        $admin = User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@vacusoftware.com',
                'password' => '777crew',
            ]
        );

        $users = factory(User::class, 11)->create();
    }
}
