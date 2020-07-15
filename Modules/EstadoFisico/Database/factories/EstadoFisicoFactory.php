<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\EstadoFisico\Entities\EstadoFisico;
use Faker\Generator as Faker;

$factory->define(EstadoFisico::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'fecha' => $faker->date('Y-m-d H:i:s'),
        'animal_id' => $faker->randomDigitNotNull,
        'active' => true,
        'condicion_id' => $faker->randomDigitNotNull,
        'locomocion_id' => $faker->randomDigitNotNull,
        'negocio_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
