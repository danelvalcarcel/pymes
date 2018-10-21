<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tipo_cliente extends Model
{
    //
        use SoftDeletes;
    protected $table ="tipo_clientes";
    protected $fillable =["nomb_tipo_cliente", "sucursale_id","empresa_id","id_establecimiento"];


    public function cliente()
    {
        return $this->hasOne('App\Cliente');
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
}



