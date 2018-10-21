<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use App\Tipos_nomina;
use App\Cargo;
use App\Centros_trabajo;
use App\CambioEps;
use App\Empleado;
use App\Enfermedade;
use App\Eps;
use App\Epp;
use App\Empleadosdocumentos;
use App\Empleadospersonas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CambioEpsController extends Controller
{
    





  protected $nombre_modulo = "Talento Humano";

    public function All_CambioEps(Request $request)
    {
        //
       
        $CambioEpss="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $CambioEpss = CambioEps::where("fecha_desde",">=",$request["busquedad"])
            ->where("fecha_hasta","<=",$request["busquedad"])
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }else{
            $CambioEpss = CambioEps::where("id",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }
       
         return view('thumano.CambioEpss.home', array("CambioEpss"=>$CambioEpss,"title_menu"=>"CambioEps",
            "title"=>"Cambio Eps","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function CambioEps_update(Request $request){

       
          $user = User::find(Auth::user()->id_usuario);
          $elemento1 = CambioEps::find($request['id']);
           $elemento1->idempleado=$request['idempleado'];
           $elemento1->documento=$request['documento'];
           $elemento1->fecha_desde=$request['fecha_desde'];
           $elemento1->fecha_hasta=$request['fecha_hasta'];
           $elemento1->remunerada=$request['remunerada'];
           $elemento1->observacion=$request['observacion'];
           $elemento1->ideps=$request['ideps'];
           
           //$elemento1->id_establecimiento=>$user->id_establecimiento;
           if($request["documento_cargar"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/',$request["documento_cargar"]);
           	$elemento1->documento_cargar=$storage_name;
           }
 			
          $elemento1->save();
         return redirect('/All_CambioEps')->with('status', "Elemento Actualizado Correctamente");

    }









     public function CambioEps_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
       	$storage_name="";
       	if($request["documento_cargar"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/', $request["documento_cargar"]);
           }
         CambioEps::create([
           'idempleado'=>$request['idempleado'],
           'documento'=>$request['documento'],
           'fecha'=>$fecha,
           'observacion'=>$request['observacion'],
           'fecha_desde'=>$request['fecha_desde'],
           'fecha_hasta'=>$request['fecha_hasta'],
           "remunerada"=>$request['remunerada'],
           'id_establecimiento'=>$user->id_establecimiento,
           'ideps'=>$request['ideps'],
           'documento_cargar'=>$storage_name
        ]);

        return redirect('/All_CambioEps')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_CambioEps($id,$ruta)
    {
        //
        	
          $modulos = Modulos::all();
          $Epss = Eps::all();
          $Epps = Epp::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        $Empleados=Empleado::all();
        $tipos_nomina = Tipos_nomina::all();
        if($ruta=="actualizar"){
          $ruta ="CambioEps_update";
           $elemento =CambioEps::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="CambioEps_create";
          $elemento1 = new stdClass();
          $elemento1->idempleado = "";
          $elemento1->documento ="";
          $elemento1->fecha ="";
          $elemento1->fecha_desde ="";
          $elemento1->fecha_hasta ="";
          $elemento1->idtipoCambioEps ="";
          $elemento1->documento_cargar="";
          $elemento1->remunerada="";
          $elemento1->observacion="";
          $elemento1->ideps="";
          
          
          $elemento = $elemento1;
        }else{
           $ruta ="All_CambioEps";
           $estilo="none";
           $elemento =CambioEps::find($id);
        }

      return view('thumano.CambioEpss.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,"tipos_nomina"=>$tipos_nomina,
        "Empleados"=>$Empleados,"Epss"=>$Epss,"Epps"=>$Epps,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_CambioEps($id)
    {
      CambioEps::destroy($id);
      return redirect('/All_CambioEps')->with('status', "Elemento Eliminado Correctamente");
    }


}
