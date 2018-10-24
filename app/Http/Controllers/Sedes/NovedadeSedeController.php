<?php

namespace App\Http\Controllers\Sedes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use App\Arl;
use App\Eps;
use App\Sedes\NovedadeSede;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NovedadeSedeController extends Controller
{
   
      public function All_NovedadeSede(Request $request)
    {
        //
       
        $NovedadeSedes="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $NovedadeSedes = NovedadeSede::where("nombre","=",$request["busquedad"])
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->paginate(10);

        }else{
            $NovedadeSedes = NovedadeSede::where("idnovedadesede",">",0)
            ->paginate(10);
        }
       
         return view('Sedes.NovedadeSedes.home', array("NovedadeSedes"=>$NovedadeSedes,"title_menu"=>"Profesion",
            "title"=>"NovedadeSedes","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function NovedadeSede_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = NovedadeSede::find($request['id']);
           $elemento1->nombre=$request["nombre"];
           $elemento1->descripcion=$request["descripcion"];
           $elemento1->codigo=$request["codigo"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           $elemento1->idsede=$user->idsede; 			
          $elemento1->save();
         return redirect('/All_NovedadeSede')->with('status', "Elemento Actualizado Correctamente");

    }









     public function NovedadeSede_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         NovedadeSede::create([
           'nombre'=>$request["nombre"],
           'descripcion'=>$request["descripcion"],
           'codigo'=>$request["codigo"],
           'id_establecimiento'=>$user->id_establecimiento,
           'idsede'=>$user->idsede
        ]);

        return redirect('/All_NovedadeSede')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_NovedadeSede($id,$ruta)
    {

          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        
        
        if($ruta=="actualizar"){
          $ruta ="NovedadeSede_update";
           $elemento =NovedadeSede::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="NovedadeSede_create";
          $elemento1 = new stdClass();
          $elemento1->idprofesion = "";
          $elemento1->nombre ="";
          $elemento1->descripcion ="";
          $elemento1->codigo ="";
          $elemento1->idsede ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_NovedadeSede";
           $estilo="none";
           $elemento =NovedadeSede::find($id);
        }

      return view('Sedes.NovedadeSedes.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_NovedadeSede($id)
    {
      NovedadeSede::destroy($id);
      return redirect('/All_NovedadeSede')->with('status', "Elemento Eliminado Correctamente");
    }


}
