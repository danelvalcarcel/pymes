<?php

namespace App\Bancos;

use Illuminate\Database\Eloquent\Model;

class Fondo extends Model
{
    //

              protected $table ="pyme_fondos";
    protected $primaryKey = 'id_fondo';
    public $timestamps = false;
    protected $fillable = [
      'id_fondo', 'nombre','isDeleted', 'createdBy', 'createdDtm', 
      'updatedDtm', 'updatedby',"tipo","id_banco","inicial","id_establecimiento",
      "id_puc","codigo"
    ];


}
