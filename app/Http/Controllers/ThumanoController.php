<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Incapacidade;
use App\Licencia;
use App\Centros_trabajo;
use App\Vacacione;
use App\Entidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class ThumanoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $nombre_modulo = "Talento Humano";
    public function index()
    {
        //
        $user = User::find(Auth::user()->id_usuario);
         $modulos = Modulos::all();
          $centros_trabajo = Centros_trabajo::where("idcentro",">",0)
            ->where('id_establecimiento',"=", $user->id_establecimiento)->get();
        
        $incapacidades= Incapacidade::where("estado" ,"=","No Aprobado")
        ->where('id_establecimiento',"=", $user->id_establecimiento)->get();
        $Vacaciones= Vacacione::where("estado" ,"=","No Aprobado")
        ->where('id_establecimiento',"=", $user->id_establecimiento)->get();
        $Licencias= Licencia::where("estado" ,"=","No Aprobado")
        ->where('id_establecimiento',"=", $user->id_establecimiento)->get();
        return view('thumano.home', array("Modulos"=>$modulos,
            "user"=>$user,"Incapacidades"=>$incapacidades,"Vacaciones"=>$Vacaciones,
            "Licencias"=>$Licencias,"centros_trabajos"=>$centros_trabajo,
            "menu"=>"layouts.menu.thumano.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
