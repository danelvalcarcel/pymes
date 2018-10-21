<?php

namespace App\Http\Controllers\Maestros;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use App\Arl;
use App\Maestros\Medida;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
class MedidaController extends Controller
{
   
     protected $nombre_modulo = "Maestros";

      public function All_Medida(Request $request)
    {
        //
       
        $Medidas="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Medidas = Medida::where("nombre","=",$request["busquedad"])
            ->where("isDeleted","<>",1)
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->where("isDeleted","<>",1)
            ->paginate(10);

        }else{
            $Medidas = Medida::where("id_medida",">",0)
            ->where("isDeleted","<>",1)
            ->paginate(10);
        }
       
         return view('maestro.Medidas.home', array("Medidas"=>$Medidas,"title_menu"=>"Unidades de Medida",
            "title"=>"Unidades de Medida","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Medida_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = Medida::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->codigo=$request["codigo"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_Medida')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Medida_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         Medida::create([
           'nombre'=>$request["nombre"],
           'codigo'=>$request["codigo"],
           'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_Medida')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Medida($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        if($ruta=="actualizar"){
          $ruta ="Medida_update";
           $elemento =Medida::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Medida_create";
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
           $ruta ="All_Medida";
           $estilo="none";
           $elemento =Medida::find($id);
        }

      return view('maestro.Medidas.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Medida($id)
    {
      //Medida::destroy($id);
      $elemento =Medida::find($id);
      $elemento->isDeleted;
      $elemento->save();
      return redirect('/All_Medida')->with('status', "Elemento Eliminado Correctamente");
    }

}
