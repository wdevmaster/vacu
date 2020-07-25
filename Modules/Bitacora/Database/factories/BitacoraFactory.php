<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Bitacora\Entities\Bitacora;
use Faker\Generator as Faker;

$factory->define(Bitacora::class, function (Faker $faker) {

    return [
        'fecha_generacion' => $faker->date('Y-m-d H:i:s'),
        'code_usuario' => $faker->randomDigitNotNull,
        'code_generado' => $faker->randomDigitNotNull,
        'entidad' => $faker->word,
        'usuario_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
