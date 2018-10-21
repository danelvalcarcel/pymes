<?php

namespace App\Maestros;

use Illuminate\Database\Eloquent\Model;

class TipoIngreso extends Model
{
    //
              protected $table ="pyme_tiposingresos";
    protected $primaryKey = 'idtipoingreso';
    public $timestamps = false;
    protected $fillable = [
       'nombre',"descripcion","id_establecimiento","isDeleted"
    ];

     
     
}
