<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_documento extends Model
{
    //
     protected $table ="pyme_tiposdocumentos";
    protected $primaryKey = 'idtipodocumento';
    public $timestamps = false;
    protected $fillable = [
		 'nombre', 'descripcion', 'codigo', 'id_establecimiento',"expira"
    ];


     public function documentos_empleado()
    {
        return $this->belongsTo('App\Empleadosdocumentos', 'idtipodocumento');
    }


}
