<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Venta\Entities\Venta;
use Faker\Generator as Faker;

$factory->define(Venta::class, function (Faker $faker) {

    return [
        'code' => $faker->word,
        'fecha' => $faker->word,
        'motivo' => $faker->word,
        'active' => $faker->word,
        'animal_id' => $faker->randomDigitNotNull,
        'cliente_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
