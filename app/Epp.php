<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Epp extends Model
{
    //

     protected $table ="pyme_epp";
    protected $primaryKey = 'idepp';
    public $timestamps = false;
    protected $fillable = [
       'idepp', 'nombre', 'nit', 'codigo', 'id_establecimiento'
    ];
}
