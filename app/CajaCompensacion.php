<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CajaCompensacion extends Model
{
    //


     protected $table ="pyme_cajadecompensacion";
    protected $primaryKey = 'idcajadecompensacion';
    public $timestamps = false;
    protected $fillable = [
       'nombre', 'descripcion',"id_establecimiento"
    ];
}
