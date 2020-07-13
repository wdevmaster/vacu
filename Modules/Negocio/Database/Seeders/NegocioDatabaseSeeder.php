<?php

namespace Modules\Negocio\Database\Seeders;

use Carbon\Carbon;
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

        $negocios = factory(Negocio::class, 1)->create([
            'code' => 1,
            'nombre' => 'Media Luna',
            'jefe' => 'Nacho',
            'telefono' => 12345678,
            'active' => true,
            'fecha_creacion' => Carbon::now(),
        ]);
    }
}
