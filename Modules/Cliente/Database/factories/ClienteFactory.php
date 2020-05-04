<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Cliente\Entities\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {

    return [
        'code' => $faker->word,
        'nombre' => $faker->word,
        'descripcion' => $faker->word,
        'telfono' => $faker->word,
        'active' => $faker->word,
        'negocio_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
