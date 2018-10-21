<?php

namespace App\Maestros;

use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    //

        //
              protected $table ="pyme_monedas";
    protected $primaryKey = 'id_moneda';
    public $timestamps = false;
    protected $fillable = [
       'nombre',"codigo","id_establecimiento","isDeleted"
    ];

}
