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
use App\Tipo_documento;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Tipo_documentoController extends Controller
{
  





    //
  protected $nombre_modulo = "Maestros";
    
    //

      public function All_Tipo_documento(Request $request)
    {
        //
       
        $Tipo_documentos="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
         
        if($request["busquedad"]){
            $Tipo_documentos = Tipo_documento::where("nombre","=",$request["busquedad"])
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->paginate(10);

        }else{
            $Tipo_documentos = Tipo_documento::where("idtipodocumento",">",0)
            ->paginate(10);
        }
       
         return view('maestro.Tipo_documentos.home', array("Tipo_documentos"=>$Tipo_documentos,"title_menu"=>"Tipo documentos",
            "title"=>"Tipo documentos","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Tipo_documento_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = Tipo_documento::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->descripcion=$request["descripcion"];
           $elemento1->codigo=$request["codigo"];
           $elemento1->expira=$request["expira"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_Tipo_documento')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Tipo_documento_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         Tipo_documento::create([
           'nombre'=>$request["nombre"],
           'descripcion'=>$request["descripcion"],
           'codigo'=>$request["codigo"],
           "expira"=>$request["expira"],
           'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_Tipo_documento')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Tipo_documento($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        
        
        if($ruta=="actualizar"){
          $ruta ="Tipo_documento_update";
           $elemento =Tipo_documento::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Tipo_documento_create";
          $elemento1 = new stdClass();
          $elemento1->idtipodocumento = "";
          $elemento1->nombre ="";
          $elemento1->descripcion ="";
          $elemento1->codigo ="";
          $elemento1->expira="";
          $elemento = $elemento1;

        }else{
           $ruta ="All_Tipo_documento";
           $estilo="none";
           $elemento =Tipo_documento::find($id);
        }

      return view('maestro.Tipo_documentos.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Tipo_documento($id)
    {
      Tipo_documento::destroy($id);
      return redirect('/All_Tipo_documento')->with('status', "Elemento Eliminado Correctamente");
    }
}
