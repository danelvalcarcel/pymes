<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retiro extends Model
{
    //


        protected $table ="pyme_retiros";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
      'idempleado', 'documento', 'fecha', 'fecha_desde', 'fecha_hasta', 'idtipomotivo', 
      'id_establecimiento',"documento_retiro"
    ];

     public function empleado()
    {
        return $this->belongsTo('App\Empleado','idempleado');
    }

}
