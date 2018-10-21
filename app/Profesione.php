<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesione extends Model
{
    //

    protected $table ="pyme_profesiones";
    protected $primaryKey = 'idprofesion';
    public $timestamps = false;
    protected $fillable = [
		 'nombre', 'descripcion', 'codigo', 'id_establecimiento'
    ];
}
