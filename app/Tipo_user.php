<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tipo_user extends Model
{
    //
        use SoftDeletes;
    protected $table="tipo_users";
    protected $fillable=["tipo_usuario","privilegios","sucursale_id","empresa_id"];


    public function user()
    {
        return $this->hasOne('App\User');
    }
    public function sucursale()
    {
        return $this->belongsTo('App\Sucursale');
    }
    //

    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
}
