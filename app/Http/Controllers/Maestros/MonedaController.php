<?php

namespace App\Http\Controllers\Maestros;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use App\Arl;
use App\Maestros\Moneda;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MonedaController extends Controller
{
   
     protected $nombre_modulo = "Maestros";

      public function All_Moneda(Request $request)
    {
        //
       
        $Monedas="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Monedas = Moneda::where("nombre","=",$request["busquedad"])
            ->where("isDeleted","<>",1)
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->where("isDeleted","<>",1)
            ->paginate(10);

        }else{
            $Monedas = Moneda::where("id_moneda",">",0)
            ->where("isDeleted","<>",1)
            ->paginate(10);
        }
       
         return view('maestro.Monedas.home', array("Monedas"=>$Monedas,"title_menu"=>"Unidades de Moneda",
            "title"=>"Unidades de Moneda","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Moneda_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = Moneda::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->codigo=$request["codigo"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_Moneda')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Moneda_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         Moneda::create([
           'nombre'=>$request["nombre"],
           'codigo'=>$request["codigo"],
           'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_Moneda')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Moneda($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        if($ruta=="actualizar"){
          $ruta ="Moneda_update";
           $elemento =Moneda::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Moneda_create";
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
           $ruta ="All_Moneda";
           $estilo="none";
           $elemento =Moneda::find($id);
        }

      return view('maestro.Monedas.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Moneda($id)
    {
      //Moneda::destroy($id);
      $elemento =Moneda::find($id);
      $elemento->isDeleted;
      $elemento->save();
      return redirect('/All_Moneda')->with('status', "Elemento Eliminado Correctamente");
    }

}
