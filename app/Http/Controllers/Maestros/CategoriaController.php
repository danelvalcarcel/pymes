<?php

namespace App\Http\Controllers\Maestros;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use App\Arl;
use App\Maestros\Categoria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    //


     protected $nombre_modulo = "Maestros";

      public function All_Categoria(Request $request)
    {
        //
       
        $Categorias="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Categorias = Categoria::where("nombre","=",$request["busquedad"])
            ->where("isDeleted","<>",1)
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->where("isDeleted","<>",1)
            ->paginate(10);

        }else{
            $Categorias = Categoria::where("id_categoria",">",0)
            ->where("isDeleted","<>",1)
            ->paginate(10);
        }
       
         return view('maestro.Categorias.home', array("Categorias"=>$Categorias,"title_menu"=>"Categoria",
            "title"=>"Categoria","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Categoria_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = Categoria::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->codigo=$request["codigo"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_Categoria')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Categoria_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         Categoria::create([
           'nombre'=>$request["nombre"],
           'codigo'=>$request["codigo"],
           'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_Categoria')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Categoria($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        if($ruta=="actualizar"){
          $ruta ="Categoria_update";
           $elemento =Categoria::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Categoria_create";
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
           $ruta ="All_Categoria";
           $estilo="none";
           $elemento =Categoria::find($id);
        }

      return view('maestro.Categorias.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Categoria($id)
    {
      //Categoria::destroy($id);
      $elemento =Categoria::find($id);
      $elemento->isDeleted;
      $elemento->save();
      return redirect('/All_Categoria')->with('status', "Elemento Eliminado Correctamente");
    }

}
