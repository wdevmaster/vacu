<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Produccion\Entities\Produccion;
use Faker\Generator as Faker;

$factory->define(Produccion::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'fecha' => $faker->date('Y-m-d H:i:s'),
        'peso' => $faker->word,
        'active' => true,
        'animal_id' => $faker->randomDigitNotNull,
        'negocio_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
