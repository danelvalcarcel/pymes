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

class EppController extends Controller
{
    //
    protected $nombre_modulo = "Maestros";
      public function All_Epp(Request $request)
    {
        //
       
        $Epps="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Epps = Epp::where("nombre","=",$request["busquedad"])
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->paginate(10);

        }else{
            $Epps = Epp::where("idepp",">",0)
            ->paginate(10);
        }
       
         return view('maestro.Epps.home', array("Epps"=>$Epps,"title_menu"=>"Afp",
            "title"=>"Afp","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Epp_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = Epp::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->nit=$request["nit"];
           $elemento1->codigo=$request["codigo"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_Epp')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Epp_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         Epp::create([
           'nombre'=>$request["nombre"],
           'nit'=>$request["nit"],
           'codigo'=>$request["codigo"],
           'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_Epp')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Epp($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        
        
        if($ruta=="actualizar"){
          $ruta ="Epp_update";
           $elemento =Epp::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Epp_create";
          $elemento1 = new stdClass();
          $elemento1->idEpp = "";
          $elemento1->nombre ="";
          $elemento1->nit ="";
          $elemento1->codigo ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_Epp";
           $estilo="none";
           $elemento =Epp::find($id);
        }

      return view('maestro.Epps.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Epp($id)
    {
      Epp::destroy($id);
      return redirect('/All_Epp')->with('status', "Elemento Eliminado Correctamente");
    }
}
