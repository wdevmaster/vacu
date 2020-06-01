<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Usuario\Entities\RolBoton;
use Faker\Generator as Faker;

$factory->define(RolBoton::class, function (Faker $faker) {

    return [
        'nombre' => $faker->word,
        'descripcion' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
