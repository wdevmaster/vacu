<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Lote\Entities\Lote;
use Faker\Generator as Faker;

$factory->define(Lote::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'numero' => $faker->randomDigitNotNull,
        'nombre' => $faker->word,
        'active' => true,
        'finca_id' => $faker->randomDigitNotNull,
        'negocio_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
