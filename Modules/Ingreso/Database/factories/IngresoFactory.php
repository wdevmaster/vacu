<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Ingreso\Entities\Ingreso;
use Faker\Generator as Faker;

$factory->define(Ingreso::class, function (Faker $faker) {

    return [
        'code' => $faker->word,
        'fecha' => $faker->word,
        'active' => $faker->word,
        'animal_id' => $faker->randomDigitNotNull,
        'lote_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
