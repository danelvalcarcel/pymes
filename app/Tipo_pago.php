<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tipo_pago extends Model
{
    //
        use SoftDeletes;
    protected $table="tipo_pagos";
    protected $fillable=["nombre_pago","codigo","sucursale_id","empresa_id","id_establecimiento"];



    public function operaciones()
    {
        return $this->hasMany('App\Operacione');
    }
}
