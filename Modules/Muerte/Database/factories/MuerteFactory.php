<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Muerte\Entities\Muerte;
use Faker\Generator as Faker;

$factory->define(Muerte::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'fecha' =>  $faker->date('Y-m-d H:i:s'),
        'motivo_id' => $faker->randomDigitNotNull,
        'animal_id' => $faker->randomDigitNotNull,
        'negocio_id' => $faker->randomDigitNotNull,
        'active'=>true,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
