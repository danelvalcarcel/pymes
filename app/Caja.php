<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Caja extends Model
{
    
        use SoftDeletes;
    protected $table="cajas";
    protected $fillable=["nomb_caja","descripcion","user_id","sucursale_id","empresa_id","id_establecimiento"];
}

