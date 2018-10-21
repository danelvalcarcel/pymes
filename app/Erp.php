<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Erp extends Model
{
    //

    protected $table ="pyme_erp";
    protected $primaryKey = 'id_erp';
    public $timestamps = false;
    protected $fillable = [
       'nombre', 'descripcion',"id_establecimiento"
    ];
}
