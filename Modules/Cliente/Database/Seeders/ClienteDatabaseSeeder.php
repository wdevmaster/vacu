<?php

namespace Modules\Cliente\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Cliente\Entities\Cliente;

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

       $cliente = factory(Cliente::class)->create([
           'code' =>1,
           'nombre' => 'Cliente Media Luna',
           'descripcion' => 'Cliente Media Luna',
           'telefono' => '1234567',
           'active' => true,
           'negocio_id' => 1
       ]);
    }
}
