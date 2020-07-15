<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\RegistroEnfermedad\Entities\RegistroEnfermedad;
use Faker\Generator as Faker;

$factory->define(RegistroEnfermedad::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'fecha_enfermedad' => $faker->date('Y-m-d H:i:s'),
        'fecha' => $faker->date('Y-m-d H:i:s'),
        'active' => true,
        'id_animal' => $faker->randomDigitNotNull,
        'id_enfermedad' => $faker->randomDigitNotNull,
        'negocio_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
