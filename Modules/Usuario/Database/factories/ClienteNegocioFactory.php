<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Usuario\Entities\ClienteNegocio;
use Faker\Generator as Faker;

$factory->define(ClienteNegocio::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'nombre' => $faker->word,
        'descripcion' => $faker->word,
        'telefono' => $faker->word,
        'active' => $faker->word,
        'negocio_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
