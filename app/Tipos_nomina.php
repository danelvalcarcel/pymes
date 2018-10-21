<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipos_nomina extends Model
{
    //
      protected $table ="pyme_tiposdenomina";
    protected $primaryKey = 'idtiponomina';
    public $timestamps = false;
    protected $fillable = [
       'nombre',"descripcion","id_establecimiento"
    ];



     public function empleado()
    {
        return $this->hasMany('App\Empleado','idtiponomina');
    }
}
