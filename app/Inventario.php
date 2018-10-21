<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventario extends Model
{
    //
        use SoftDeletes;
    protected $table="inventarios";
    protected $fillable=["codigo",'producto_id',"cantidad",'bodega_id',"estado",
                "sucursale_id","empresa_id","id_establecimiento"];


    public function producto()
    {
        return $this->belongsTo('App\Producto');
    }


    public function operaciones()
    {
        return $this->belongsToMany('App\Operacione')->withPivot("cantidad_inv","dinero","descuento","observacion","sucursale_id","empresa_id");;
    }
/*
    public function inventario_operacione()
    {
        return $this->belongsToMany('App\inventario_operacione');

    }

*/
    public function bodega()
    {
        return $this->belongsTo('App\Bodega');
    }

}
