<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoLicencia extends Model
{
    //

              protected $table ="pyme_tiposlicencias";
    protected $primaryKey = 'idtipolicencia';
    public $timestamps = false;
    protected $fillable = [
       'nombre',"descripcion","id_establecimiento"
    ];
}
