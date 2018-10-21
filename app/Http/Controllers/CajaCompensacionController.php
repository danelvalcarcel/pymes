<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use App\Arl;
use App\CajaCompensacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CajaCompensacionController extends Controller
{
    protected $nombre_modulo = "Maestros";

      public function All_CajaCompensacion(Request $request)
    {
        //
       
        $CajaCompensacions="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $CajaCompensacions = CajaCompensacion::where("nombre","=",$request["busquedad"])
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->paginate(10);

        }else{
            $CajaCompensacions = CajaCompensacion::where("idcajadecompensacion",">",0)
            ->paginate(10);
        }
       
         return view('maestro.CajaCompensacions.home', array("CajaCompensacions"=>$CajaCompensacions,"title_menu"=>"CajaCompensacion",
            "title"=>"Caja de Compensacion","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function CajaCompensacion_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = CajaCompensacion::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->descripcion=$request["descripcion"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_CajaCompensacion')->with('status', "Elemento Actualizado Correctamente");

    }









     public function CajaCompensacion_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         CajaCompensacion::create([
           'nombre'=>$request["nombre"],
           'descripcion'=>$request["descripcion"],
           'codigo'=>$request["codigo"],
           'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_CajaCompensacion')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_CajaCompensacion($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        if($ruta=="actualizar"){
          $ruta ="CajaCompensacion_update";
           $elemento =CajaCompensacion::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="CajaCompensacion_create";
          $elemento1 = new stdClass();
          $elemento1->idcajadecompensacion = "";
          $elemento1->nombre ="";
          $elemento1->descripcion ="";
          $elemento1->codigo ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_CajaCompensacion";
           $estilo="none";
           $elemento =CajaCompensacion::find($id);
        }

      return view('maestro.CajaCompensacions.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_CajaCompensacion($id)
    {
      CajaCompensacion::destroy($id);
      return redirect('/All_CajaCompensacion')->with('status', "Elemento Eliminado Correctamente");
    }

}
