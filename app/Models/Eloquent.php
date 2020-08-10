<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 1/05/20
 * Time: 9:20
 */

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends Model
{
    protected $dates = ['fecha', 'fecha_nacimiento'];

    public function setFechaAttribute($value)
    {

        $this->attributes['fecha'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setFechaNacimientoAttribute($value)
    {
        $this->attributes['fecha_nacimiento'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }


}
