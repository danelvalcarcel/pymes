<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CambioEps extends Model
{
    


                protected $table ="pyme_cambioeps";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
      'idempleado', 'documento', 'fecha', 'fecha_desde', 'fecha_hasta',
       'idtipolicencia', 'id_establecimiento',"documento_incapacidad",
       "observacion","documento_cargar","ideps"
    ];

     public function empleado()
    {
        return $this->belongsTo('App\Empleado','idempleado');
    }
}
