<?php

namespace Modules\Cliente\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Usuario\Entities\ClienteNegocio;

class ClienteDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

       $cliente = factory(ClienteNegocio::class)->create([
           'code' =>1,
           'nombre' => 'Cliente Media Luna',
           'descripcion' => 'Cliente Media Luna',
           'telfono' => '1234567',
           'active' => true,
           'negocio_id' => 1
       ]);
    }
}
