<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eps extends Model
{
    //

     protected $table ="pyme_eps";
    protected $primaryKey = 'ideps';
    public $timestamps = false;
    protected $fillable = [
		 'nombre', 'nit', 'codigo', 'id_establecimiento'
    ];
}
