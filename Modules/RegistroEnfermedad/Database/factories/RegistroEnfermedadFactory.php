<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\RegistroEnfermedad\Entities\RegistroEnfermedad;
use Faker\Generator as Faker;

$factory->define(RegistroEnfermedad::class, function (Faker $faker) {

    return [
        'code' => $faker->word,
        'fecha_enfermedad' => $faker->word,
        'fecha' => $faker->word,
        'active' => $faker->word,
        'id_animal' => $faker->randomDigitNotNull,
        'id_enfermedad' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
