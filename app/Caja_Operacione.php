<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Caja_Operacione extends Model
{
    //
        use SoftDeletes;
    protected $table ='caja_operaciones';
    protected $fillable = ['operacione_id',"caja_id","dinero", 'tipo_pago_id',"sucursale_id","empresa_id","id_establecimiento"];

    public function operaciones()
    {
        return $this->belongsToMany('App\Operacione');
    }
}
