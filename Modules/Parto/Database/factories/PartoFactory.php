<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Parto\Entities\Parto;
use Faker\Generator as Faker;

$factory->define(Parto::class, function (Faker $faker) {

    return [
        'code' => $faker->word,
        'fecha' => $faker->word,
        'sexo' => $faker->word,
        'animal_nacido' => $faker->word,
        'madre_code' => $faker->word,
        'active' => $faker->word,
        'raza_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
