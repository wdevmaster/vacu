<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\Sincronizacion\Entities\Syncronizacion;

$factory->define(Syncronizacion::class, function (Faker $faker) {


    $tabla = $faker->randomElement(
        [
            \Modules\Configuracion\Entities\Configuracion::$tableName,
            \Modules\Animal\Entities\Animal::$tableName,
            \Modules\CondicionCorporal\Entities\CondicionCorporal::$tableName,
            \Modules\Enfermedad\Entities\Enfermedad::$tableName,
            \Modules\Negocio\Entities\Negocio::$tableName
        ]);

    switch ($tabla) {
        case \Modules\Configuracion\Entities\Configuracion::$tableName:
            $data = factory(\Modules\Configuracion\Entities\Configuracion::class, 1)->make();
            return [
                'tabla' => $tabla,
                'accion' => $faker->randomElement(['INSERT', 'UPDATE', 'DELETE']),
                'data' => $data->get(0)->toJson(),
                'user_id' => $faker->numberBetween(1, 2),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => $faker->date('Y-m-d H:i:s')
            ];
            break;

        case \Modules\Animal\Entities\Animal::$tableName:
            $data = factory(\Modules\Animal\Entities\Animal::class, 1)->make();
            return [
                'tabla' => $tabla,
                'accion' => $faker->randomElement(['INSERT', 'UPDATE', 'DELETE']),
                'data' => $data->get(0)->toJson(),
                'user_id' => $faker->numberBetween(1, 2),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => $faker->date('Y-m-d H:i:s')
            ];
            break;

        case \Modules\CondicionCorporal\Entities\CondicionCorporal::$tableName:
            $data = factory(\Modules\CondicionCorporal\Entities\CondicionCorporal::class, 1)->make();
            return [
                'tabla' => $tabla,
                'accion' => $faker->randomElement(['INSERT', 'UPDATE', 'DELETE']),
                'data' => $data->get(0)->toJson(),
                'user_id' => $faker->numberBetween(1, 2),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => $faker->date('Y-m-d H:i:s')
            ];
            break;
        case \Modules\Enfermedad\Entities\Enfermedad::$tableName:
            $data = factory(\Modules\Enfermedad\Entities\Enfermedad::class, 1)->make();
            return [
                'tabla' => $tabla,
                'accion' => $faker->randomElement(['INSERT', 'UPDATE', 'DELETE']),
                'data' => $data->get(0)->toJson(),
                'user_id' => $faker->numberBetween(1, 2),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => $faker->date('Y-m-d H:i:s')
            ];
            break;

        case \Modules\Negocio\Entities\Negocio::$tableName:
            $data = factory(\Modules\Negocio\Entities\Negocio::class, 1)->make();
            return [
                'tabla' => $tabla,
                'accion' => $faker->randomElement(['INSERT', 'UPDATE', 'DELETE']),
                'data' => $data->get(0)->toJson(),
                'user_id' => $faker->numberBetween(1, 2),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => $faker->date('Y-m-d H:i:s')
            ];
            break;
    }


});
