<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centros_trabajo extends Model
{
    //
     protected $table ="pyme_centrosdetrabajo";
    protected $primaryKey = 'idcentro';
    public $timestamps = false;
    protected $fillable = [
       'nombre',"descripcion","id_establecimiento"
    ];


         public function empleado()
    {
        return $this->hasMany('App\Empleado','idcentro');
    }
}
