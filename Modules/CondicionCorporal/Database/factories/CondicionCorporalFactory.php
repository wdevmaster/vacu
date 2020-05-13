<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\CondicionCorporal\Entities\CondicionCorporal;
use Faker\Generator as Faker;

$factory->define(CondicionCorporal::class, function (Faker $faker) {

    return [
        'code' => 12,
        'nombre' => $faker->word,
        'descripcion' => $faker->word,
        'active' => true,
        'negocio_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
