<?php

namespace App\Maestros;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //


          protected $table ="pyme_categoria";
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;
    protected $fillable = [
       'nombre',"codigo","id_establecimiento","isDeleted"
    ];


}
