<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\Sincronizacion\Entities\Syncronizacion;

$factory->define(Syncronizacion::class, function (Faker $faker) {


    $tabla = $faker->randomElement(
        [
            \Modules\Configuracion\Entities\Configuracion::$tableName,
            \Modules\Animal\Entities\Animal::$tableName,
            \Modules\CondicionCorporal\Entities\CondicionCorporal::$tableName
        ]);

    switch ($tabla) {
        case \Modules\Configuracion\Entities\Configuracion::$tableName:
            return [
                'tabla' => $tabla,
                'accion' => $faker->randomElement(['INSERT', 'UPDATE', 'DELETE']),
                'data' => $faker->randomElement(['{ "code": 1 , "descripcion": "descripcion1" , "valor": "valor1" }']),
                'user_id' => $faker->numberBetween(1, 2),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => $faker->date('Y-m-d H:i:s')
            ];
            break;

        case \Modules\Animal\Entities\Animal::$tableName:
            return [
                'tabla' => $tabla,
                'accion' => $faker->randomElement(['INSERT', 'UPDATE', 'DELETE']),
                'data' => '{
                  "code": 12,
                  "fecha_nacimiento": "2020-05-12 14:37:39",
                  "sexo": "M", "lote_nacimiento_id": 1,
                  "madre_codigo": 1, "padre_codigo":12,
                  "raza_codigo":12, "lote_actual_id":12,
                  "locomocion_code":12,
                  "temporal_id":12,
                  "inventario_id":12,
                  "active":true
                  }' ,
                'user_id' => $faker->numberBetween(1, 2),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => $faker->date('Y-m-d H:i:s')
            ];
            break;

        case \Modules\CondicionCorporal\Entities\CondicionCorporal::$tableName:
            return [
                'tabla' => $tabla,
                'accion' => $faker->randomElement(['INSERT', 'UPDATE', 'DELETE']),
                'data' => '{
                  "code": 123,
                  "nombre": "nombre1",
                  "descripcion": "descripcion",
                  "active":true,
                  "negocio_id":1
                  }' ,
                'user_id' => $faker->numberBetween(1, 2),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => $faker->date('Y-m-d H:i:s')
            ];
            break;
    }


});
