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

class ProvisionalController extends Controller
{

	  protected $nombre_modulo = "Bancos";

   
    public function All_Archivo_Sistema(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaX', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.bancos.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }

     public function All_Archivo_Beneficiario(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaX', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.bancos.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }

     public function All_Archivo_Registro(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaY', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.bancos.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }


     public function All_Archivo_Modificacione(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaX', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.bancos.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }

     public function All_Archivo_CuentasCobra(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaY', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.bancos.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }


     public function All_Archivo_CuentasPaga(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaY', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.bancos.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }


     public function All_Archivo_Conciliacione(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaY', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.bancos.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }


     public function All_Archivo_Cotizacione(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaX', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.bancos.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }



	
	     public function All_Reporte_Banco(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaY', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.bancos.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }



     public function All_Varios_Mensuale(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaY', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.bancos.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }


     public function All_Varios_Indice(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaX', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.bancos.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }




    
     public function All_Reimprime_Fact(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaX', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.ventasc.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }



     public function All_Reimprime_Dev(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaX', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.ventasc.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }






     public function All_Remision_Rece(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaX', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.ventasc.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }

         public function All_Remision_Reimpre(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaX', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.ventasc.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }


         public function All_Remision_Elimina(){
     $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('bancos.vistaX', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.ventasc.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }


}
