<?php

namespace App\Http\Controllers\Maestros;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use App\Arl;
use App\Maestros\TipoEgreso;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TipoEgresoController extends Controller
{
    //


     protected $nombre_modulo = "Maestros";

      public function All_TipoEgreso(Request $request)
    {
        //
       
        $TipoEgresos="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $TipoEgresos = TipoEgreso::where("nombre","=",$request["busquedad"])
            ->where("isDeleted","<>",1)
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->where("isDeleted","<>",1)
            ->paginate(10);

        }else{
            $TipoEgresos = TipoEgreso::where("idtipoegreso",">",0)
            ->where("isDeleted","<>",1)
            ->paginate(10);
        }
       
         return view('maestro.TipoEgresos.home', array("TipoEgresos"=>$TipoEgresos,"title_menu"=>"Tipo Egreso",
            "title"=>"Tipo Egreso","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function TipoEgreso_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = TipoEgreso::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->descripcion=$request["descripcion"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_TipoEgreso')->with('status', "Elemento Actualizado Correctamente");

    }









     public function TipoEgreso_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         TipoEgreso::create([
           'nombre'=>$request["nombre"],
           'descripcion'=>$request["descripcion"],
           'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_TipoEgreso')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_TipoEgreso($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        if($ruta=="actualizar"){
          $ruta ="TipoEgreso_update";
           $elemento =TipoEgreso::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="TipoEgreso_create";
          $elemento1 = new stdClass();
          $elemento1->idtipoegreso = "";
          $elemento1->nombre ="";
          $elemento1->tipo ="";
          $elemento1->descripcion ="";
          $elemento1->corriente ="";
          $elemento1->manejatercero ="";
          $elemento1->id_establecimiento ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_TipoEgreso";
           $estilo="none";
           $elemento =TipoEgreso::find($id);
        }

      return view('maestro.TipoEgresos.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_TipoEgreso($id)
    {
      //TipoEgreso::destroy($id);
      $elemento =TipoEgreso::find($id);
      $elemento->isDeleted;
      $elemento->save();
      return redirect('/All_TipoEgreso')->with('status', "Elemento Eliminado Correctamente");
    }

}
