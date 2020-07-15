<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Inseminador\Entities\Inseminador;
use Faker\Generator as Faker;

$factory->define(Inseminador::class, function (Faker $faker) {

    return [
        'codigo' => $faker->randomDigitNotNull,
        'nombre' => $faker->word,
        'active' => true,
        'negocio_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
