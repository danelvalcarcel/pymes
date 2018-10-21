<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Inventario_Operacione extends Model
{
    //
        use SoftDeletes;
    protected $table="inventario_operacione";
    protected $fillable =['operacione_id','inventario_id',"cantidad_inv","dinero",

                        "descuento","sucursale_id","empresa_id","id_establecimiento"];


/*
   public function operaciones()
    {
        return $this->belongsTo('App\Operacione');
    }
    public function inventarios()
    {
        return $this->belongsTo('App\Inventario');
    }


*/
}
