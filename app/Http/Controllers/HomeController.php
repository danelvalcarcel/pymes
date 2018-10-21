<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Modulos;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $nombre_modulo = "Admin";
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('home', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }

  
}
