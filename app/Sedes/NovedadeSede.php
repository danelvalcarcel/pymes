<?php

namespace App\Sedes;

use Illuminate\Database\Eloquent\Model;

class NovedadeSede extends Model
{
    


      protected $table ="pyme_novedadesedes";
    protected $primaryKey = 'idnovedadesede';
    public $timestamps = false;
    protected $fillable = [
		 'nombre', 'descripcion', 'codigo', 'id_establecimiento',"idsede"
    ];
}
