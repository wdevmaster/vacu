<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Modules\Usuario\Entities\UserApk;
use Faker\Generator as Faker;

$factory->define(UserApk::class, function (Faker $faker) {

    return [
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
