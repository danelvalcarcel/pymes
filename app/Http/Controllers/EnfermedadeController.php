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
use App\Enfermedade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EnfermedadeController extends Controller
{
   


    //
    protected $nombre_modulo = "Maestros";
    //

      public function All_Enfermedade(Request $request)
    {
        //
       
        $Enfermedades="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Enfermedades = Enfermedade::where("nombre","=",$request["busquedad"])
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->paginate(10);

        }else{
            $Enfermedades = Enfermedade::where("idtipoenfermedad",">",0)
            ->paginate(10);
        }
       
         return view('maestro.Enfermedades.home', array("Enfermedades"=>$Enfermedades,"title_menu"=>"Enfermedade",
            "title"=>"Enfermedades","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Enfermedade_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = Enfermedade::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->descripcion=$request["descripcion"];
           $elemento1->codigo=$request["codigo"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_Enfermedade')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Enfermedade_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         Enfermedade::create([
           'nombre'=>$request["nombre"],
           'descripcion'=>$request["descripcion"],
           'codigo'=>$request["codigo"],
           'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_Enfermedade')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Enfermedade($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        
        
        if($ruta=="actualizar"){
          $ruta ="Enfermedade_update";
           $elemento =Enfermedade::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Enfermedade_create";
          $elemento1 = new stdClass();
          $elemento1->idtipoenfermedad = "";
          $elemento1->nombre ="";
          $elemento1->descripcion ="";
          $elemento1->codigo ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_Enfermedade";
           $estilo="none";
           $elemento =Enfermedade::find($id);
        }

      return view('maestro.Enfermedades.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Enfermedade($id)
    {
      Enfermedade::destroy($id);
      return redirect('/All_Enfermedade')->with('status', "Elemento Eliminado Correctamente");
    }
}
