<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Animal\Entities\Celo;
use Faker\Generator as Faker;

$factory->define(Celo::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'animal_code' => $faker->randomDigitNotNull,
        'fecha' => $faker->date('Y-m-d H:i:s'),
        'negocio_id' => $faker->randomDigitNotNull,
        'active' => true,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
