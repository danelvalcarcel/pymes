<?php

namespace App\Maestros;

use Illuminate\Database\Eloquent\Model;

class Puc extends Model
{
    //

            protected $table ="pyme_puc";
    protected $primaryKey = 'id_cuenta';
    public $timestamps = false;
    protected $fillable = [
       'id_cuenta', 'nombre', 'tipo', 'codigo',"corriente","manejatercero",
        'id_establecimiento',"isDeleted"
    ];
}
