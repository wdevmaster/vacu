<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Sincronizacion\Entities\Syncronizacion;
use Faker\Generator as Faker;

$factory->define(Syncronizacion::class, function (Faker $faker) {

    return [
        'table' => $faker->word,
        'accion' => $faker->word,
        'data' => $faker->word,
        'user_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
