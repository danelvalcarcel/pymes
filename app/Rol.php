<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
     protected $table ="pyme_roles";
    protected $primaryKey = 'roleId';
    public $timestamps = false;
    protected $fillable = [
       'role'
    ];

}
