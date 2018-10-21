<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class SedesController extends Controller
{
    //
    protected $nombre_modulo = "sedes";

    public function index()
    {
        //
         $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('Sedes.home', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.sedes.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }
}
