<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
    protected $table ="pyme_empleados";
    protected $primaryKey = 'idempleado';
    public $timestamps = false;
    protected $fillable = [
       'contrato', 'documento', 'ideps', 'idpension', 'idtiponomina', 'idcentro', 
       'fecha_nacimiento', 'fecha_ingreso', 'fecha_terminacion', 'fondo', 'nombres',
        'apellidos', 'direccion', 'telefono', 'liquidarsalud', 'liquidarpension',
         'idcargo', 'genero', 'idempresa', 'nivelestudios', 'idprofesion',
          'id_establecimiento',"sueldo","talla_camisa","talla_pantalon","email",
          "talla_zapatos","rh","tipocontrato","tipodocumento","logo"
    ];


    public function mis_events()
    {
        return $this->hasMany('App\EventoEmpleado', 'idempleado');
    }

    public function documentos()
    {
        return $this->hasMany('App\Empleadosdocumentos', 'idempleado');
    }

    public function personas()
    {
        return $this->hasMany('App\Empleadospersonas', 'idempleado');
    }

    public function incapacidad()
    {
        return $this->hasMany('App\Incapacidade', 'idempleado');
    }

    public function retiro()
    {
        return $this->hasMany('App\Retiro', 'idempleado');
    }

    public function licencia()
    {
        return $this->hasMany('App\Licencia', 'idempleado');
    }

    public function vacacione()
    {
        return $this->hasMany('App\Vacacione', 'idempleado');
    }


    public function cambioeps()
    {
        return $this->hasMany('App\CambioEps', 'idempleado');
    }

    public function cambioafp()
    {
        return $this->hasMany('App\CambioAfp', 'idempleado');
    }


    public function novedade()
    {
        return $this->hasMany('App\Novedade', 'idempleado');
    }

    public function tipo_nomina()
    {
        return $this->belongsTo('App\Tipos_nomina', 'idtiponomina');
    }



    public function Cargo()
    {
        return $this->belongsTo('App\Cargo', 'idcargo');
    }


    public function Centro_trabajo()
    {
        return $this->belongsTo('App\Centros_trabajo', 'idcentro');
    }


    public function Entidad()
    {
        return $this->belongsTo('App\Entidad', 'id_establecimiento');
    }


    public function evento()
    {
        return $this->hasMany('App\Evento', 'idempleado');
    }
}
