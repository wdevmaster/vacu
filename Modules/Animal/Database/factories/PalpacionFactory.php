<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Animal\Entities\Palpacion;
use Faker\Generator as Faker;

$factory->define(Palpacion::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'animal_code' => $faker->randomDigitNotNull,
        'celo_id' => $faker->randomDigitNotNull,
        'fecha' => $faker->date('Y-m-d H:i:s'),
        'active' => true,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
