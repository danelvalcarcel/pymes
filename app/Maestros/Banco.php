<?php

namespace App\Maestros;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    //


          protected $table ="pyme_bancos";
    protected $primaryKey = 'idbanco';
    public $timestamps = false;
    protected $fillable = [
       'nombre',"codigo","id_establecimiento","isDeleted"
    ];



}
