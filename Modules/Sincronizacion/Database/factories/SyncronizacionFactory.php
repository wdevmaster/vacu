<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Sincronizacion\Entities\Syncronizacion;
use Faker\Generator as Faker;

$factory->define(Syncronizacion::class, function (Faker $faker) {

    return [
        'table' => 'configuraciones',
        'accion' => $faker->randomElement(['INSERT','UPDATE', 'DELETE']),
        'data' => $faker->randomElement(['[{ "key": "clave", "value": "clave1" }, { "key": "descripcion", "value": "descripcion1" }, { "key": "valor", "value": "valor1" } ]']),
        'user_id' => $faker->numberBetween(1,2),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
