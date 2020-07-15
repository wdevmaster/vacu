<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Evento\Entities\Evento;
use Faker\Generator as Faker;

$factory->define(Evento::class, function (Faker $faker) {

    return [
        'fecha' => $faker->date('Y-m-d H:i:s'),
        'animal_id' => $faker->randomDigitNotNull,
        'negocio_id' => $faker->randomDigitNotNull,
        'tipo_evento' => $faker->word,
        'active'=>true,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
