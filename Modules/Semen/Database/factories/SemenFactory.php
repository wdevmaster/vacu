<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Semen\Entities\Semen;
use Faker\Generator as Faker;

$factory->define(Semen::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'active' => true,
        'id_animal' => $faker->randomDigitNotNull,
        'negocio_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
