<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Configuracion\Entities\Configuracion;
use Faker\Generator as Faker;

$factory->define(Configuracion::class, function (Faker $faker) {

    return [
        'configuracion_id' => $faker->word,
        'clave' => $faker->word,
        'description' => $faker->word,
        'valor' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
