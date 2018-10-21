<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Medida extends Model
{
    //
        use SoftDeletes;
    protected $table="medidas";
    protected $fillable=["nombre","codigo","sucursale_id","empresa_id","id_establecimiento"];
}
