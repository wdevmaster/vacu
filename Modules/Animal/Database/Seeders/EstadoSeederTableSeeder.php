<?php

namespace Modules\Animal\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Animal\Entities\Estado;

class EstadoSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //Default States

        $defaults = [
            'Celo',
            'Serviciada Positivo',
            'Serviciada Negativo',
            'Palpada Positiva',
            'Palpada Negativa',
            'Normal',
        ];

        foreach ($defaults as $default){
            factory(Estado::class)->create([
                'nombre' => $default
            ]);
        }
    }
}
