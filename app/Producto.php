<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Producto extends Model
{
    //
        use SoftDeletes;
    protected $table="productos";
    protected $fillable=["nombre","codigo",'categoria_id',"tamanio",'medida_id',
                        "color","foto","estado","descripcion","precio_costo","precio_venta",
                        "estado_iva","sucursale_id","empresa_id","id_establecimiento"];

    public function inventario()
    {
        return $this->hasMany('App\Inventario');
    }

}
