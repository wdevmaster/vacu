<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Venta\Entities\MotivoVenta;
use Faker\Generator as Faker;

$factory->define(MotivoVenta::class, function (Faker $faker) {

    return [
        'nombre' => $faker->word,
        'descripcion' => $faker->word,
        'active' => true,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
