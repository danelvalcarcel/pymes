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
use App\Licencia;
use App\Empleado;
use App\Enfermedade;
use App\Empleadosdocumentos;
use App\Empleadospersonas;
use App\TipoLicencia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LicenciaController extends Controller
{
    



  protected $nombre_modulo = "Talento Humano";

    public function All_Licencia(Request $request)
    {
        //
       
        $Licencias="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Licencias = Licencia::where("fecha_desde",">=",$request["busquedad"])
            ->where("fecha_hasta","<=",$request["busquedad"])
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }else{
            $Licencias = Licencia::where("id",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }
       
         return view('thumano.Licencias.home', array("Licencias"=>$Licencias,"title_menu"=>"Licencia",
            "title"=>"Licencias","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Licencia_update(Request $request){

       
          $user = User::find(Auth::user()->id_usuario);
          $elemento1 = Licencia::find($request['id']);
           $elemento1->idempleado=$request['idempleado'];
           $elemento1->documento=$request['documento'];
           $elemento1->fecha_desde=$request['fecha_desde'];
           $elemento1->fecha_hasta=$request['fecha_hasta'];
           $elemento1->idtipolicencia=$request['idtipolicencia'];
           $elemento1->remunerada=$request['remunerada'];
           $elemento1->observacion=$request['observacion'];
           
           //$elemento1->id_establecimiento=>$user->id_establecimiento;
           if($request["documento_licencia"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/',$request["documento_licencia"]);
           	$elemento1->documento_licencia=$storage_name;
           }
 			
          $elemento1->save();
         return redirect('/All_Licencia')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Licencia_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
       	$storage_name="";
       	if($request["documento_licencia"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/', $request["documento_licencia"]);
           }
         Licencia::create([
           'idempleado'=>$request['idempleado'],
           'documento'=>$request['documento'],
           'fecha'=>$fecha,
           'observacion'=>$request['observacion'],
           'fecha_desde'=>$request['fecha_desde'],
           'fecha_hasta'=>$request['fecha_hasta'],
           'idtipolicencia'=>$request['idtipolicencia'],
           "remunerada"=>$request['remunerada'],
           'id_establecimiento'=>$user->id_establecimiento,
           'documento_licencia'=>$storage_name
        ]);

        return redirect('/All_Licencia')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Licencia($id,$ruta)
    {
        //
        	
          $modulos = Modulos::all();
          $Enfermedades =TipoLicencia::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        $Empleados=Empleado::all();
        $tipos_nomina = Tipos_nomina::all();
        if($ruta=="actualizar"){
          $ruta ="Licencia_update";
           $elemento =Licencia::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Licencia_create";
          $elemento1 = new stdClass();
          $elemento1->idempleado = "";
          $elemento1->documento ="";
          $elemento1->fecha ="";
          $elemento1->fecha_desde ="";
          $elemento1->fecha_hasta ="";
          $elemento1->idtipolicencia ="";
          $elemento1->documento_licencia="";
          $elemento1->remunerada="";
          $elemento1->observacion="";
          
          
          $elemento = $elemento1;
        }else{
           $ruta ="All_Licencia";
           $estilo="none";
           $elemento =Licencia::find($id);
        }

      return view('thumano.Licencias.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,"tipos_nomina"=>$tipos_nomina,
        "Empleados"=>$Empleados,"Enfermedades"=>$Enfermedades,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Licencia($id)
    {
      Licencia::destroy($id);
      return redirect('/All_Licencia')->with('status', "Elemento Eliminado Correctamente");
    }
}
