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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class EpsController extends Controller
{
    protected $nombre_modulo = "Maestros";

      public function All_Eps(Request $request)
    {
        //
       
        $Epss="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Epss = Eps::where("nombre","=",$request["busquedad"])
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->paginate(10);

        }else{
            $Epss = Eps::where("ideps",">",0)
            ->paginate(10);
        }
       
         return view('maestro.Epss.home', array("Epss"=>$Epss,"title_menu"=>"Eps",
            "title"=>"Eps","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Eps_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = Eps::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->nit=$request["nit"];
           $elemento1->codigo=$request["codigo"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_Eps')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Eps_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         Eps::create([
           'nombre'=>$request["nombre"],
           'nit'=>$request["nit"],
           'codigo'=>$request["codigo"],
           'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_Eps')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Eps($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        if($ruta=="actualizar"){
          $ruta ="Eps_update";
           $elemento =Eps::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Eps_create";
          $elemento1 = new stdClass();
          $elemento1->ideps = "";
          $elemento1->nombre ="";
          $elemento1->nit ="";
          $elemento1->codigo ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_Eps";
           $estilo="none";
           $elemento =Eps::find($id);
        }

      return view('maestro.Epss.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Eps($id)
    {
      Eps::destroy($id);
      return redirect('/All_Eps')->with('status', "Elemento Eliminado Correctamente");
    }

}
