<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    //

     protected $table ="pyme_ciudades";
    protected $primaryKey = 'idciudad';
    public $timestamps = false;
    protected $fillable = [
       'nombre'
    ];
}
