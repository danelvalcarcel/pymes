<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arl extends Model
{
    //

        protected $table ="pyme_arl";
    protected $primaryKey = 'idarl';
    public $timestamps = false;
    protected $fillable = [
       'idarl', 'nombre', 'nit', 'codigo', 'id_establecimiento'
    ];
}
