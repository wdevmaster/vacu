<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Lactancia\Entities\Lactancia;
use Faker\Generator as Faker;

$factory->define(Lactancia::class, function (Faker $faker) {

    return [
        'code' => $faker->randomDigitNotNull,
        'fecha' =>  $faker->date('Y-m-d H:i:s'),
        'leche' => $faker->word,
        'concentrado' => $faker->word,
        'peso' => $faker->word,
        'animal_id' => $faker->randomDigitNotNull,
        'negocio_id' => $faker->randomDigitNotNull,
        'active'=>true,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
