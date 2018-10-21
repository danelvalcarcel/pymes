<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    //
    protected $table ="pyme_cargos";
    protected $primaryKey = 'idcargo';
    public $timestamps = false;
    protected $fillable = [
       'nombre',"descripcion","sueldo","idtiponomina","id_establecimiento"
    ];

      public function empleado()
    {
        return $this->hasMany('App\Empleado','idcargo');
    }
}
