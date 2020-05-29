<?php

namespace Modules\Negocio\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Negocio\Entities\Negocio;

class NegocioDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $negocios = factory(Negocio::class, 20)->create();
    }
}
