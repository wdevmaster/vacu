<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Negocio\Entities\Negocio;
use Faker\Generator as Faker;

$factory->define(Negocio::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'nombre' => $faker->word,
        'jefe' => $faker->word,
        'telefono' => $faker->randomDigitNotNull,
        'active' => true,
        'fecha_creacion' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
