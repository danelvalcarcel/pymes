<?php

namespace App\Maestros;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //


    
    protected $table ="pyme_articulos";
    protected $primaryKey = 'id_articulo';
    public $timestamps = false;
    protected $fillable = [
      'id_articulo', 'nombre', 'id_categoria', 'valor_costo', 
      'valor_venta', 'isDeleted', 'createdBy', 'createdDtm', 
      'updatedDtm', 'updatedby', 'porcentaje_iva',
       'porcentaje_descuento', 'valor_iva', 
       'valor_descuento', 'id_medida', 'valor_pormayor',"utilidad",
       "valor_total","tipo","id_establecimiento","codigo","inicial"
    ];


}
