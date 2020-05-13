<?php

namespace Modules\Sincronizacion\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Sincronizacion\Entities\Syncronizacion;

class SincronizacionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $sincronizaciones = factory(Syncronizacion::class, 20)->create();
    }
}
