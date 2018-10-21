<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tipo_cuenta_pendiente extends Model
{
    //
        use SoftDeletes;
    protected $table="tipo_cuenta_pendientes";
    protected $fillable=["nombre"];
}
