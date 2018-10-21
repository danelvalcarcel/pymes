<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    //
     protected $table ="pyme_establecimientos";
    protected $primaryKey = 'id_establecimiento';
    public $timestamps = false;
    protected $fillable = [
       'documento', 'nombre', 'direccion', 'telefono', 'estado', 'isDeleted', 'createdBy', 'createdDtm', 'updatedby', 'updatedDtm',"celular","residencia_dian","regimen",
       "doc_representante","id_erp","id_ciudad","nit","nombre_representante"
    ];


     public function user()
    {
        return $this->hasMany('App\User', 'id_establecimiento');
    }

      public function empleado()
    {
        return $this->hasMany('App\Empleado','id_establecimiento');
    }

}
