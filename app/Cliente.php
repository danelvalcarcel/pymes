<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Cliente extends Model

{
        use SoftDeletes;
    protected $table ="clientes";
    protected $fillable =['firts_name','last_name','email','cedula',"pais","departamento",
                        "municipio","direccion","tel_fijo","celular_1","celular_2","observacion","tipo_cliente_id",
                        "sucursale_id","empresa_id","id_establecimiento"];


    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function tipo_cliente()
    {
        return $this->belongsTo('App\Tipo_cliente');
    }

    public function sucursale()
    {
        return $this->belongsTo('App\Sucursale');
    }
    //

    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }

    public function operacione()
    {
        return $this->hasMany('App\Operacione');
    }
}
