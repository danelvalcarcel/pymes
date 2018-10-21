<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleadospersonas extends Model
{
    //

    protected $table ="pyme_empleadospersonas";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
       'idempleado','documento', 'tipoparentesco', 'nombres', 'apellidos', 'fechanacimeinto', 'genero', 
    ];

     public function empleado()
    {
        return $this->belongsTo('App\Empleado','idempleado');
    }
}
