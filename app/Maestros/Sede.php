<?php

namespace App\Maestros;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    //


      protected $table ="pyme_sedes";
    protected $primaryKey = 'idsede';
    public $timestamps = false;
    protected $fillable = [
		 'nombre', 'descripcion', 'codigo', 'id_establecimiento',
		 "direccion", "telefono", "contacto"
    ];



     public function Entidad()
    {
        return $this->belongsTo('App\Entidad', 'id_establecimiento');
    }


    public function User()
    {
        return $this->hasmany('App\User', 'idsede');
    }
}
