<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoMotivo extends Model
{
    //

          protected $table ="pyme_tiposmotivos";
    protected $primaryKey = 'idtipomotivo';
    public $timestamps = false;
    protected $fillable = [
       'nombre',"descripcion","id_establecimiento"
    ];


}
