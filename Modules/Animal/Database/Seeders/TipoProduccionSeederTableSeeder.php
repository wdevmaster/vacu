<?php
/**
 * Created by IntelliJ IDEA.
 * User: roli
 * Date: 29/09/20
 * Time: 8:25
 */

namespace Modules\Animal\Database\Seeders;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Animal\Entities\TipoProduccion;

class TipoProduccionSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //Default States

        $defaults = [
            'Leche',
            'Carne',
            'Doble Proposito',
        ];

        foreach ($defaults as $default){
            factory(TipoProduccion::class)->create([
                'nombre' => $default
            ]);
        }
    }

}
