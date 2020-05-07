<?php

namespace Modules\Usuario\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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
        $users = factory(User::class, 3)->create();
    }
}
