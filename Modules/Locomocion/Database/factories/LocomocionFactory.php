<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Locomocion\Entities\Locomocion;
use Faker\Generator as Faker;

$factory->define(Locomocion::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'nombre' => $faker->word,
        'descripcion' => $faker->word,
        'active' => true,
        'negocio_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
