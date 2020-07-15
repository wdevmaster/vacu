<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Cliente\Entities\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'nombre' => $faker->word,
        'descripcion' => $faker->word,
        'telefono' => $faker->word,
        'active' => true,
        'negocio_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
