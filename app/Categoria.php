<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Categoria extends Model
{
    //
        use SoftDeletes;
    protected $table ="categorias";
     protected $fillable =["nombre_categoria","sucursale_id","empresa_id","id_establecimiento"];
}
