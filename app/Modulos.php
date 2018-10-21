<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    //
     protected $table ="pyme_modulos";
    protected $primaryKey = 'id_esquema';
    public $timestamps = false;
    protected $fillable = [
       'esquema', 'estado', 'abreviacion', 'descripcion', 'cerrado'
    ];

}
