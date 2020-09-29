<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Animal\Entities\Animal;
use Faker\Generator as Faker;

$factory->define(Animal::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'fecha_nacimiento' => $faker->date('Y-m-d H:i:s'),
        'sexo' => $faker->word,
        'lote_nacimiento_id' => $faker->randomDigitNotNull,
        'madre_codigo' => $faker->randomDigitNotNull,
        'padre_codigo' => $faker->randomDigitNotNull,
        'raza_codigo' => $faker->randomDigitNotNull,
        'lote_actual_id' => $faker->randomDigitNotNull,
        'locomocion_code' => $faker->randomDigitNotNull,
        'temporal_id' => $faker->randomDigitNotNull,
        'codigo_trabajo' => $faker->word,
        'inventario_id' => $faker->randomDigitNotNull,
        'negocio_id' => $faker->randomDigitNotNull,
        'active' => true,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
