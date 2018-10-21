<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Sucursale extends Model
{
    //
        use SoftDeletes;
    protected $table="sucursales";
    protected $fillable=["nomb_sucursal",'email',"pais","ciudad","direccion","tel_fijo",
                        "celular_1","celular_2","observacion","empresa_id","id_establecimiento"];

    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }


}


