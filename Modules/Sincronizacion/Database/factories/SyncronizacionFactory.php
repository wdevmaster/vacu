<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Sincronizacion\Entities\Syncronizacion;
use Faker\Generator as Faker;

$factory->define(Syncronizacion::class, function (Faker $faker) {

    return [
        'tabla' => 'configuraciones',
        'accion' => $faker->randomElement(['INSERT','UPDATE', 'DELETE']),
        'data' => $faker->randomElement(['{ "clave": "clave1" , "descripcion": "descripcion1" , "valor": "valor1" }']),
        'user_id' => $faker->numberBetween(1,2),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
