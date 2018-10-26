<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incapacidade extends Model
{
    //


    protected $table ="pyme_incapacidades";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
      'idempleado', 'documento', 'fecha', 'fecha_desde', "estado",
      'fecha_hasta', 'idtipoenfermedad', 'id_establecimiento',
      "documento_incapacidad","idtipomotivo"
    ];

     public function empleado()
    {
        return $this->belongsTo('App\Empleado','idempleado');
    }

        public function TipoMotivo()
    {
        return $this->belongsTo('App\TipoMotivo', 'idtipomotivo');
    }

      public function Enfermedad()
    {
        return $this->belongsTo('App\Enfermedade', 'idtipoenfermedad');
    }

}
