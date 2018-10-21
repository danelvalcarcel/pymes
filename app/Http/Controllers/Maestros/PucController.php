<?php

namespace App\Http\Controllers\Maestros;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use App\Arl;
use App\Maestros\Puc;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PucController extends Controller
{
    //

    protected $nombre_modulo = "Maestros";

      public function All_Puc(Request $request)
    {
        //
       
        $Pucs="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Pucs = Puc::where("nombre","=",$request["busquedad"])
            ->where("isDeleted","<>",1)
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->where("isDeleted","<>",1)
            ->paginate(10);

        }else{
            $Pucs = Puc::where("id_cuenta",">",0)
            ->where("isDeleted","<>",1)
            ->paginate(10);
        }
       
         return view('maestro.Pucs.home', array("Pucs"=>$Pucs,"title_menu"=>"Puc",
            "title"=>"Puc","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Puc_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = Puc::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->codigo=$request["codigo"];
           $elemento1->tipo =$request["tipo"];
          $elemento1->corriente =$request["corriente"];
          $elemento1->manejatercero =$request["manejatercero"];;
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_Puc')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Puc_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         Puc::create([
           'nombre'=>$request["nombre"],
           'nit'=>$request["nit"],
           'codigo'=>$request["codigo"],
           'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_Puc')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Puc($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        if($ruta=="actualizar"){
          $ruta ="Puc_update";
           $elemento =Puc::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Puc_create";
          $elemento1 = new stdClass();
          $elemento1->id_cuenta = "";
          $elemento1->nombre ="";
          $elemento1->tipo ="";
          $elemento1->codigo ="";
          $elemento1->corriente ="";
          $elemento1->manejatercero ="";
          $elemento1->id_establecimiento ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_Puc";
           $estilo="none";
           $elemento =Puc::find($id);
        }

      return view('maestro.Pucs.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Puc($id)
    {
      //Puc::destroy($id);
      $elemento =Puc::find($id);
      $elemento->isDeleted;
      $elemento->save();
      return redirect('/All_Puc')->with('status', "Elemento Eliminado Correctamente");
    }

}
