<?php

namespace App\Maestros;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    //
              protected $table ="pyme_unidades";
    protected $primaryKey = 'idunidade';
    public $timestamps = false;
    protected $fillable = [
       'nombre',"codigo","id_establecimiento","isDeleted"
    ];

}
