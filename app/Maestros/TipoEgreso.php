<?php

namespace App\Maestros;

use Illuminate\Database\Eloquent\Model;

class TipoEgreso extends Model
{
    //

              protected $table ="pyme_tiposegresos";
    protected $primaryKey = 'idtipoegreso';
    public $timestamps = false;
    protected $fillable = [
       'nombre',"descripcion","id_establecimiento","isDeleted"
    ];

       
       
}
