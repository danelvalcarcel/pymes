<?php

namespace App\Http\Controllers\Maestros;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use App\Arl;
use App\Maestros\TipoIngreso;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TipoIngresoController extends Controller
{
    //

     protected $nombre_modulo = "Maestros";

      public function All_TipoIngreso(Request $request)
    {
        //
       
        $TipoIngresos="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $TipoIngresos = TipoIngreso::where("nombre","=",$request["busquedad"])
            ->where("isDeleted","<>",1)
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->where("isDeleted","<>",1)
            ->paginate(10);

        }else{
            $TipoIngresos = TipoIngreso::where("idtipoingreso",">",0)
            ->where("isDeleted","<>",1)
            ->paginate(10);
        }
       
         return view('maestro.TipoIngresos.home', array("TipoIngresos"=>$TipoIngresos,"title_menu"=>"Tipo Ingreso",
            "title"=>"Tipo Ingreso","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function TipoIngreso_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = TipoIngreso::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->codigo=$request["descripcion"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_TipoIngreso')->with('status', "Elemento Actualizado Correctamente");

    }









     public function TipoIngreso_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         TipoIngreso::create([
           'nombre'=>$request["nombre"],
           'descripcion'=>$request["descripcion"],
           'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_TipoIngreso')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_TipoIngreso($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        if($ruta=="actualizar"){
          $ruta ="TipoIngreso_update";
           $elemento =TipoIngreso::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="TipoIngreso_create";
          $elemento1 = new stdClass();
          $elemento1->idtipoingreso = "";
          $elemento1->nombre ="";
          $elemento1->tipo ="";
          $elemento1->descripcion ="";
          $elemento1->corriente ="";
          $elemento1->manejatercero ="";
          $elemento1->id_establecimiento ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_TipoIngreso";
           $estilo="none";
           $elemento =TipoIngreso::find($id);
        }

      return view('maestro.TipoIngresos.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_TipoIngreso($id)
    {
      //TipoIngreso::destroy($id);
      $elemento =TipoIngreso::find($id);
      $elemento->isDeleted;
      $elemento->save();
      return redirect('/All_TipoIngreso')->with('status', "Elemento Eliminado Correctamente");
    }

}
