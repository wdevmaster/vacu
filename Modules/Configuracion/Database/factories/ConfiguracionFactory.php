<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Configuracion\Entities\Configuracion;
use Faker\Generator as Faker;

$factory->define(Configuracion::class, function (Faker $faker) {

    return [
        'code' => 123,
        'descripcion' => $faker->word,
        'valor' => $faker->randomDigitNotNull,
        'clave' => $faker->randomDigitNotNull,
        'active' => true,
        'negocio_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
