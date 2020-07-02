<?php

namespace Modules\Raza\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Raza\Entities\Raza;

class RazaDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        $razas  = [
            'Simental',
            'Chambrain',
            'Brahaman',
        ];
        $codes  = [
            1,
            2,
            3,
        ];

        for ($i = 0;  $i < count($razas); $i++){
            factory(Raza::class)->create([
                'code' => $codes[$i],
                'nombre' => $razas[$i],
                'active' => true,
            ]);
        }


    }
}
