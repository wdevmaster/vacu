<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 3/07/20
 * Time: 7:15
 */

namespace Modules\Usuario\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Usuario\Entities\RolBoton;

class RolBotonesSeeder extends Seeder
{
    public function run()
    {
       $roles_botones_default = [
           'btn_eventos',
           'btn_historico',
           'btn_inventario',
           'btn_controldefinca',
           'btn_salud',
           'btn_producción',
           'btn_terneras',
           'btn_reproduccion',
           'btn_ingresoafinca',
           'btn_configuracion',
           'btn_sincronizacion',
           'btn_IngresoAFincas',
           'btn_Ventas',
           'btn_Muertes',
           'btn_Enfermedades',
           'Btn_MedicionesFisicas',
           'btn_Historico_Terneras',
           'btn_Lactancia',
           'btn_Partos',
           'btn_Servicios',
           'btn_Celo',
           'btn_Palpacion',
       ];

       for ($i = 0; $i < count($roles_botones_default); $i++ ){
           $rol_boton = factory(RolBoton::class)->create([
               'nombre' => $roles_botones_default[$i],
               'descripcion' => $roles_botones_default[$i],
           ]);
       }
    }
}
