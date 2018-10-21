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
use App\Epp;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArlController extends Controller
{
    //
  protected $nombre_modulo = "Maestros";

     public function All_Arl(Request $request)
    {
        //
       
        $Arls="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Arls = Arl::where("nombre","=",$request["busquedad"])
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->paginate(10);

        }else{
            $Arls = Arl::where("idarl",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }
       
         return view('maestro.Arls.home', array("Arls"=>$Arls,"title_menu"=>"Arl",
            "title"=>"Arls","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Arl_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = Arl::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->nit=$request["nit"];
           $elemento1->codigo=$request["codigo"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_Arl')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Arl_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         Arl::create([
           'nombre'=>$request["nombre"],
           'nit'=>$request["nit"],
           'codigo'=>$request["codigo"],
           'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_Arl')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Arl($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        
        
        if($ruta=="actualizar"){
          $ruta ="Arl_update";
           $elemento =Arl::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Arl_create";
          $elemento1 = new stdClass();
          $elemento1->idarl = "";
          $elemento1->nombre ="";
          $elemento1->nit ="";
          $elemento1->codigo ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_Arl";
           $estilo="none";
           $elemento =Arl::find($id);
        }

      return view('maestro.Arls.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Arl($id)
    {
      Arl::destroy($id);
      return redirect('/All_Arl')->with('status', "Elemento Eliminado Correctamente");
    }


}
