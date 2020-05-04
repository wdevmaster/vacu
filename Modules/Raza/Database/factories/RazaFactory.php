<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Raza\Entities\Raza;
use Faker\Generator as Faker;

$factory->define(Raza::class, function (Faker $faker) {

    return [
        'code' => $faker->word,
        'nombre' => $faker->word,
        'active' => $faker->word,
        'negocio_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
