<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfermedade extends Model
{
    //


    protected $table ="pyme_enfermedades";
    protected $primaryKey = 'idtipoenfermedad';
    public $timestamps = false;
    protected $fillable = [
      'codigo', 'nombre', 'descripcion', 'id_establecimiento'
    ];


       public function Incapacidade()
    {
        return $this->hasMany('App\Incapacidade','idtipoenfermedad');
    }
}
