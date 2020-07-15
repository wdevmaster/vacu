<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\TipoServicio\Entities\TipoServicio;
use Faker\Generator as Faker;

$factory->define(TipoServicio::class, function (Faker $faker) {

    return [
        'id' => $faker->randomDigitNotNull,
        'code' => $faker->randomDigitNotNull,
        'nombre' => $faker->word,
        'active' => true,
        'descripcion' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
