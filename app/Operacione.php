<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
class Operacione extends Model
{
    //
        use SoftDeletes;
    protected $table="operaciones";
    protected $fillable=["tipo_operacione_id","cliente_id","consecutivo","observacion","user_id",
                            "sucursale_id","empresa_id","total","id_establecimiento"];

    public function caja_operacione()
    {
        return $this->belongsToMany('App\Caja_Operacione');
    }
    public function tipo_pago()
    {
        return $this->belongsToMany('App\Tipo_pago');
    }
    public function inventarios()
    {
        return $this->belongsToMany('App\Inventario')
            ->withPivot("cantidad_inv","dinero","descuento","sucursale_id","empresa_id");
    }
/*
    public function inventario_operaciones()
    {
        return $this->belongsToMany('App\inventario_operacione');
    }

*/
    public function tipo_operacione()
    {
        return $this->belongsTo('App\Tipo_operacione');
    }


    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

}
