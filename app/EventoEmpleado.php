<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventoEmpleado extends Model
{
    //



	 protected $table ="pyme_eventos_empleados";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
       'idempleado',"idevento"
    ];

    public function evento()
    {
        return $this->belongsTo('App\Evento','idevento');
    }

        public function empleado()
    {
        return $this->belongsTo('App\Empleado','idempleado');
    }

}
