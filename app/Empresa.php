<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Empresa extends Model
{
    //
        use SoftDeletes;
    protected $table ="empresas";
    protected $fillable =["nomb_empresa",'cod_identificacion','email',"pais","ciudad",
                        "direccion","tel_fijo","celular_1","celular_2","observacion"];

    public function sucursale()
    {
        return $this->hasOne('App\Sucursale');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
    public function Cliente()
    {
        return $this->hasOne('App\Cliente');
    }

}
