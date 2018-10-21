<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
    protected $table ="pyme_users";
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;
    protected $fillable = [
       'correo', 'clave', 'nombres', 'mobile', 'roleid', 'isDeleted',
        'createdBy', 'createdDtm', 'updatedBy', 'updatedDtm',
         'id_establecimiento', 'login', 'role', 'estado',"modulos_id"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
 'remember_token'
    ];


    public function entidad()
    {
        return $this->belongsTo('App\Entidad','id_establecimiento');
    }


    
}
