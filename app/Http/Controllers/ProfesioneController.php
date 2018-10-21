<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use App\Arl;
use App\Eps;
use App\Profesione;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class ProfesioneController extends Controller
{
   





protected $nombre_modulo = "Maestros";

    //
    
    //

      public function All_Profesione(Request $request)
    {
        //
       
        $Profesiones="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Profesiones = Profesione::where("nombre","=",$request["busquedad"])
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->paginate(10);

        }else{
            $Profesiones = Profesione::where("idprofesion",">",0)
            ->paginate(10);
        }
       
         return view('maestro.Profesiones.home', array("Profesiones"=>$Profesiones,"title_menu"=>"Profesion",
            "title"=>"Profesiones","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Profesione_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = Profesione::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->descripcion=$request["descripcion"];
           $elemento1->codigo=$request["codigo"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_Profesione')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Profesione_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         Profesione::create([
           'nombre'=>$request["nombre"],
           'descripcion'=>$request["descripcion"],
           'codigo'=>$request["codigo"],
           'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_Profesione')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Profesione($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        
        
        if($ruta=="actualizar"){
          $ruta ="Profesione_update";
           $elemento =Profesione::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Profesione_create";
          $elemento1 = new stdClass();
          $elemento1->idprofesion = "";
          $elemento1->nombre ="";
          $elemento1->descripcion ="";
          $elemento1->codigo ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_Profesione";
           $estilo="none";
           $elemento =Profesione::find($id);
        }

      return view('maestro.Profesiones.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Profesione($id)
    {
      Profesione::destroy($id);
      return redirect('/All_Profesione')->with('status', "Elemento Eliminado Correctamente");
    }


    
}
