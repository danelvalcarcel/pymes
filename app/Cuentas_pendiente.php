<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Cuentas_pendiente extends Model
{

    use SoftDeletes;
    protected $table="cuentas_pendientes";
    protected $fillable= ["operacione_id","cliente_id","user_id","deuda_inicial","deuda_cancelada","deuda_pendiente",
                        "tipo_cuenta_pendiente_id","sucursale_id","empresa_id","id_establecimiento"];
}
