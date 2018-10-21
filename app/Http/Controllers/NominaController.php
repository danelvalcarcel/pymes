<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use App\Tipos_nomina;
use App\Cargo;
use App\Centros_trabajo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class NominaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $nombre_modulo = "Nomina";
    public function index()
    {
        //
         $modulos = Modulos::all();
        $user = User::find(Auth::user()->id_usuario);
        return view('nomina.home', array("Modulos"=>$modulos,
            "user"=>$user,
            "menu"=>"layouts.menu.nomina.admin",
            "nombre_modulo"=>$this->nombre_modulo));
    }




    public function All_tipos_nomina(Request $request)
    {
        //
       $user = User::find(Auth::user()->id_usuario);
       $modulos = Modulos::all();
        $tipos_nominas="";
          $establecimiento="";
          $operador="";
         if($user->role==2){
          $establecimiento = 0;
          $operador=">";
         }else{
          $operador="=";
        $establecimiento = $user->id_establecimiento;   
         }
        if($request["busquedad"]){
            $tipos_nominas = Tipos_nomina::where("nombre","=",$request["busquedad"])
            ->where('id_establecimiento', $operador, $establecimiento)
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->where('id_establecimiento', $operador, $establecimiento)
            ->paginate(10);
        }else{
            $tipos_nominas = Tipos_nomina::where("idtiponomina",">",0)
            ->where('id_establecimiento', $operador, $establecimiento)
            ->paginate(10);
        }
       
         return view('nomina.tipos_nomina.home', array("tipos_nominas"=>$tipos_nominas,"title_menu"=>"Tipo de Nomina","Modulos"=>$modulos,
            "title"=>"Tipos de Nomina","user"=>$user,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function tipos_nomina_update(Request $request){
        $this->validate($request, [
             'nombre'=> 'required|string|max:255',
             'descripcion'=> 'required|string|max:255',
    ]);
       

          $elemento1 = Tipos_nomina::find($request['id']);
           $elemento1->nombre = $request['nombre'];
          $elemento1->descripcion =$request['descripcion'];
          $elemento1->save();
         return redirect('/All_tipos_nomina')->with('status', "Elemento Actualizado Correctamente");

    }









     public function tipos_nomina_create(Request $request){

         $this->validate($request, [
             'nombre'=> 'required|string|max:255',
             'descripcion'=> 'required|string|max:255',
    ]);
        $user = User::find(Auth::user()->id_usuario);
       
         Tipos_nomina::create([
            'descripcion'=>$request['descripcion'],
            'nombre'=>$request['nombre'],
            'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_tipos_nomina')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_tipos_nomina($id,$ruta)
    {
        //

           $estilo="";
        $elemento="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($ruta=="actualizar"){
          $ruta ="tipos_nomina_update";
           $elemento =Tipos_nomina::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="tipos_nomina_create";
          $elemento1 = new stdClass();
          $elemento1->descripcion = "";
          $elemento1->nombre ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_tipos_nomina";
           $estilo="none";
           $elemento =Tipos_nomina::find($id);
        }

      return view('nomina.tipos_nomina.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,
        "user"=>$user, "Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_tipos_nomina($id)
    {
      Tipos_nomina::destroy($id);
      return redirect('/All_tipos_nomina')->with('status', "Elemento Eliminado Correctamente");
    }































 public function All_centros_trabajo(Request $request)
    {
        //
        $centros_trabajo="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
          $establecimiento="";
          $operador="";
         if($user->role==2){
          $establecimiento = 0;
          $operador=">";
         }else{
          $operador="=";
        $establecimiento = $user->id_establecimiento;   
         }
        if($request["busquedad"]){
            $centros_trabajo = Centros_trabajo::where("nombre","=",$request["busquedad"])
            ->where('id_establecimiento', $operador, $establecimiento)
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->where('id_establecimiento', $operador, $establecimiento)
            ->paginate(10);
        }else{
            $centros_trabajo = Centros_trabajo::where("idcentro",">",0)
            ->where('id_establecimiento', $operador, $establecimiento)
            ->paginate(10);
        }
       
         return view('nomina.centros.home', array("centros_trabajos"=>$centros_trabajo,"title_menu"=>"Centro de Trabajo",
            "title"=>"Centros de Trabajos",
            "user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function centros_trabajo_update(Request $request){
        $this->validate($request, [
             'nombre'=> 'required|string|max:255',
             'descripcion'=> 'required|string|max:255',
    ]);
       

          $elemento1 = Centros_trabajo::find($request['id']);
           $elemento1->nombre = $request['nombre'];
          $elemento1->descripcion =$request['descripcion'];
          $elemento1->save();
         return redirect('/All_centros_trabajo')->with('status', "Elemento Actualizado Correctamente");

    }









     public function centros_trabajo_create(Request $request){

         $this->validate($request, [
             'nombre'=> 'required|string|max:255',
             'descripcion'=> 'required|string|max:255',
    ]);
        $user = User::find(Auth::user()->id_usuario);
         Centros_trabajo::create([
            'descripcion'=>$request['descripcion'],
            'nombre'=>$request['nombre'],
             'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_centros_trabajo')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_centros_trabajo($id,$ruta)
    {
        //
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
           $modulos = Modulos::all();
        $elemento="";
        if($ruta=="actualizar"){
          $ruta ="centros_trabajo_update";
           $elemento =Centros_trabajo::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="centros_trabajo_create";
          $elemento1 = new stdClass();
          $elemento1->descripcion = "";
          $elemento1->nombre ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_centros_trabajo";
           $estilo="none";
           $elemento =Centros_trabajo::find($id);
        }

      return view('nomina.centros.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,
        "estilo"=>$estilo, "Modulos"=>$modulos,
        "user"=>$user,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_centros_trabajo($id)
    {
      Centros_trabajo::destroy($id);
      return redirect('/All_centros_trabajo')->with('status', "Elemento Eliminado Correctamente");
    }
























 public function All_cargo(Request $request)
    {
        //
        $cargos="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
          $establecimiento="";
          $operador="";
         if($user->role == 2){
          $establecimiento = 0;
          $operador=">";
         
         }else{
          $operador="=";

        $establecimiento = $user->id_establecimiento;   
  
         }
        if($request["busquedad"]){
            $cargos = Cargo::where("nombre","=",$request["busquedad"])
            ->where('id_establecimiento', $operador, $establecimiento)
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->where('id_establecimiento', $operador, $establecimiento)
            ->paginate(10);
        }else{
            $cargos = Cargo::where("idcargo",">",0)
            ->where('id_establecimiento', $operador, $establecimiento)
            ->paginate(10);
        }
       
         return view('nomina.cargos.home', array("cargos"=>$cargos,"title_menu"=>"Cargo",
            "title"=>"Cargos","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function cargo_update(Request $request){
        $this->validate($request, [
             'nombre'=> 'required|string|max:255',
             'descripcion'=> 'required|string|max:255',
             'sueldo'=> 'required',
             'idtiponomina'=> 'numeric|max:255',
    ]);
       

          $elemento1 = Cargo::find($request['id']);
           $elemento1->nombre = $request['nombre'];
          $elemento1->descripcion =$request['descripcion'];
          $elemento1->sueldo =$request['sueldo'];
          $elemento1->idtiponomina =$request['idtiponomina'];
          
          $elemento1->save();
         return redirect('/All_cargo')->with('status', "Elemento Actualizado Correctamente");

    }









     public function cargo_create(Request $request){

         $this->validate($request, [
             'nombre'=> 'required|string|max:255',
             'descripcion'=> 'required|string|max:255',
             'sueldo'=> 'required',
             'idtiponomina'=> 'numeric|max:255',
    ]);
        $user = User::find(Auth::user()->id_usuario);
         Cargo::create([
            'descripcion'=>$request['descripcion'],
            'nombre'=>$request['nombre'],
            'sueldo'=>$request['sueldo'],
            "idtiponomina"=>$request['idtiponomina'],
             'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_cargo')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_cargo($id,$ruta)
    {
        //
          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        $tipos_nomina = Tipos_nomina::where('id_establecimiento', "=", $user->id_establecimiento)
        ->get();
        if($ruta=="actualizar"){
          $ruta ="cargo_update";
           $elemento =Cargo::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="cargo_create";
          $elemento1 = new stdClass();
          $elemento1->descripcion = "";
          $elemento1->nombre ="";
          $elemento1->idtiponomina ="";
          $elemento1->sueldo ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_cargo";
           $estilo="none";
           $elemento =Cargo::find($id);
        }

      return view('nomina.cargos.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,"tipos_nomina"=>$tipos_nomina,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_cargo($id)
    {
      Cargo::destroy($id);
      return redirect('/All_cargo')->with('status', "Elemento Eliminado Correctamente");
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
