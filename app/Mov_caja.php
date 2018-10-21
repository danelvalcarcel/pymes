<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Mov_caja extends Model
{
    //
        use SoftDeletes;
    protected $table="mov_cajas";
    protected $fillable=["caja_id","operacion_id","sucursale_id","empresa_id","id_establecimiento"];
}
