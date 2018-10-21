<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Bodega extends Model
{
    //
    use SoftDeletes;
    protected $table="bodegas";
    protected $fillable=["nombre","ubicacion","capacidad","codigo",
    'medida_id',"sucursale_id","empresa_id","id_establecimiento"];


    public function inventario()
    {
        return $this->hasOne('App\Inventario');
    }
}
