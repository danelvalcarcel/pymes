<?php

namespace App\Http\Controllers\Maestros;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use App\Arl;
use App\Maestros\Banco;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BancoController extends Controller
{
   
   
     protected $nombre_modulo = "Maestros";

      public function All_Banco(Request $request)
    {
        //
       
        $Bancos="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Bancos = Banco::where("nombre","=",$request["busquedad"])
            ->where("isDeleted","<>",1)
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->where("isDeleted","<>",1)
            ->paginate(10);

        }else{
            $Bancos = Banco::where("idbanco",">",0)
            ->where("isDeleted","<>",1)
            ->paginate(10);
        }
       
         return view('maestro.Bancos.home', array("Bancos"=>$Bancos,"title_menu"=>"Banco",
            "title"=>"Banco","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Banco_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = Banco::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->codigo=$request["codigo"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_Banco')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Banco_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         Banco::create([
           'nombre'=>$request["nombre"],
           'codigo'=>$request["codigo"],
           'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_Banco')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Banco($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        if($ruta=="actualizar"){
          $ruta ="Banco_update";
           $elemento =Banco::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Banco_create";
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
           $ruta ="All_Banco";
           $estilo="none";
           $elemento =Banco::find($id);
        }

      return view('maestro.Bancos.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Banco($id)
    {
      //Banco::destroy($id);
      $elemento =Banco::find($id);
      $elemento->isDeleted=1;
      $elemento->save();
      return redirect('/All_Banco')->with('status', "Elemento Eliminado Correctamente");
    }
}
