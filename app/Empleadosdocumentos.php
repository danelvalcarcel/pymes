<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleadosdocumentos extends Model
{
    //
    protected $table ="pyme_empleadosdocumentos";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
       'idempleado', 'idtipodocumento', 'fecha_vencimiento',"nombre"
    ];


    public function empleado()
    {
        return $this->belongsTo('App\Empleado','idempleado');
    }


     public function tipo_documento()
    {
        return $this->belongsTo('App\Tipo_documento','idtipodocumento');
    }
}
