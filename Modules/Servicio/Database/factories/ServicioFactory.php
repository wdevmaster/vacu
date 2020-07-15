<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Servicio\Entities\Servicio;
use Faker\Generator as Faker;

$factory->define(Servicio::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'fecha' =>  $faker->date('Y-m-d H:i:s'),
        'animal_inceminado' => $faker->randomDigitNotNull,
        'animal_inseminador' => $faker->randomDigitNotNull,
        'semen_id' => $faker->randomDigitNotNull,
        'personal_inseminador' => $faker->word,
        'active' => true,
        'tipo_servicio_id' => $faker->randomDigitNotNull,
        'negocio_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
