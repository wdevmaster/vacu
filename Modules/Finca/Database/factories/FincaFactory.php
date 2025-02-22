<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Finca\Entities\Finca;
use Faker\Generator as Faker;

$factory->define(Finca::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'nombre' => $faker->word,
        'numero' => $faker->randomDigitNotNull,
        'negocio_id' => $faker->randomDigitNotNull,
        'active' => true,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
