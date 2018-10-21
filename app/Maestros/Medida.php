<?php

namespace App\Maestros;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    //
              protected $table ="pyme_medidas";
    protected $primaryKey = 'id_medida';
    public $timestamps = false;
    protected $fillable = [
       'nombre',"codigo","id_establecimiento","isDeleted"
    ];

}
