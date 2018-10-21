<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Cupo extends Model
{
    //
        use SoftDeletes;
    protected $table="cupos";
    protected $fillable=["cliente_id","user_id","cupo_total","cupo_disponible",
                        "sucursale_id","empresa_id","id_establecimiento"];
}
