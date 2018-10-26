<?php

namespace App\Http\Controllers\Maestros;


use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use App\Arl;
use App\Eps;
use App\TipoMotivo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class MotivoController extends Controller
{
    
    //
    protected $nombre_modulo = "Maestros";
    //

      public function All_Motivo(Request $request)
    {
        //
       
        $Motivos="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Motivos = TipoMotivo::where("nombre","=",$request["busquedad"])
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->paginate(10);

        }else{
            $Motivos = TipoMotivo::where("idtipomotivo",">",0)
            ->paginate(10);
        }
       
         return view('maestro.Motivos.home', array("Motivos"=>$Motivos,"title_menu"=>"Motivo",
            "title"=>"Motivos","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Motivo_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = TipoMotivo::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->descripcion=$request["descripcion"];
           $elemento1->codigo=$request["codigo"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_Motivo')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Motivo_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         TipoMotivo::create([
           'nombre'=>$request["nombre"],
           'descripcion'=>$request["descripcion"],
           'codigo'=>$request["codigo"],
           'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_Motivo')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Motivo($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        
        
        if($ruta=="actualizar"){
          $ruta ="Motivo_update";
           $elemento =TipoMotivo::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Motivo_create";
          $elemento1 = new stdClass();
          $elemento1->idtipoenfermedad = "";
          $elemento1->nombre ="";
          $elemento1->descripcion ="";
          $elemento1->codigo ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_Motivo";
           $estilo="none";
           $elemento =TipoMotivo::find($id);
        }

      return view('maestro.Motivos.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Motivo($id)
    {
      TipoMotivo::destroy($id);
      return redirect('/All_Motivo')->with('status', "Elemento Eliminado Correctamente");
    }
}
