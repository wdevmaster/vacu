<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Lactancia\Entities\Lactancia;
use Faker\Generator as Faker;

$factory->define(Lactancia::class, function (Faker $faker) {

    return [
        'code' => $faker->word,
        'fecha' => $faker->word,
        'leche' => $faker->word,
        'concentrado' => $faker->word,
        'peso' => $faker->word,
        'animal_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
