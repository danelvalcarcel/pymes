<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Mov_cuentas_pendiente extends Model
{
    //
        use SoftDeletes;
    protected $table="mov_cuentas_pendientes";
    protected $fillable= ["operacion_id","saldo_cancelado","sucursale_id","empresa_id","id_establecimiento"];
}
