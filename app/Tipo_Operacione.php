<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tipo_Operacione extends Model
{
    //
        use SoftDeletes;
    protected $table ="tipo_operaciones";
    protected $fillable=["nombre_operacion","inventario","dinero",
                        "sucursale_id","empresa_id","id_establecimiento"];

    public function operaciones()
    {
        return $this->hasMany('App\Operacione');
    }
}
