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
use App\Maestros\Sede;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class SedeController extends Controller
{
   





protected $nombre_modulo = "Maestros";

    //
    
    //

      public function All_Sede(Request $request)
    {
        //
       
        $Sedes="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Sedes = Sede::where("nombre","=",$request["busquedad"])
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->paginate(10);

        }else{
            $Sedes = Sede::where("idsede",">",0)
            ->paginate(10);
        }
       
         return view('maestro.Sedes.home', array("Sedes"=>$Sedes,"title_menu"=>"Profesion",
            "title"=>"Sedes","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Sede_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = Sede::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->descripcion=$request["descripcion"];
           $elemento1->codigo=$request["codigo"];

           $elemento1->direccion=$request["direccion"];
           $elemento1->telefono=$request["telefono"];
           $elemento1->contacto=$request["contacto"];

           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_Sede')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Sede_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         Sede::create([
           'nombre'=>$request["nombre"],
           'descripcion'=>$request["descripcion"],
           'codigo'=>$request["codigo"],
           'id_establecimiento'=>$request["id_establecimiento"],
           "direccion"=>$request["direccion"],
            "telefono"=>$request["telefono"],
             "contacto"=>$request["contacto"]
        ]);

        return redirect('/All_Sede')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Sede($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        $Entidades = Entidad::All();
        
        if($ruta=="actualizar"){
          $ruta ="Sede_update";
           $elemento =Sede::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Sede_create";
          $elemento1 = new stdClass();
          $elemento1->idprofesion = "";
          $elemento1->nombre ="";
          $elemento1->descripcion ="";
          $elemento1->codigo ="";
          $elemento1->id_establecimiento ="";

          $elemento1->direccion ="";
          $elemento1->telefono ="";
          $elemento1->contacto ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_Sede";
           $estilo="none";
           $elemento =Sede::find($id);
        }

      return view('maestro.Sedes.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,"Entidades"=>$Entidades,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Sede($id)
    {
      Sede::destroy($id);
      return redirect('/All_Sede')->with('status', "Elemento Eliminado Correctamente");
    }


}
