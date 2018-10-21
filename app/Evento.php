<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    //

                    protected $table ="pyme_eventos";
    protected $primaryKey = 'idevento';
    public $timestamps = false;
    protected $fillable = [
      'idempleado', 'documento', 'fecha', 'fecha_desde', 'fecha_hasta',
       'idtipolicencia', 'id_establecimiento',"documento_incapacidad",
       "observacion","documento_cargar","forma","nombre"
    ];

     public function empleado()
    {
        return $this->belongsTo('App\Empleado','idempleado');
    }

    public function empleados()
    {
        return $this->hasMany('App\EventoEmpleado', 'idevento');
    }
}
