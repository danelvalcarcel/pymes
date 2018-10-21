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
use App\Vacacione;
use App\Empleado;
use App\Enfermedade;
use App\Empleadosdocumentos;
use App\Empleadospersonas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VacacioneController extends Controller
{
    



  protected $nombre_modulo = "Talento Humano";

    public function All_Vacacione(Request $request)
    {
        //
       
        $Vacaciones="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Vacaciones = Vacacione::where("fecha_desde",">=",$request["busquedad"])
            ->where("fecha_hasta","<=",$request["busquedad"])
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }else{
            $Vacaciones = Vacacione::where("id",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }
       
         return view('thumano.Vacaciones.home', array("Vacaciones"=>$Vacaciones,"title_menu"=>"Vacacione",
            "title"=>"Vacaciones","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Vacacione_update(Request $request){

       
          $user = User::find(Auth::user()->id_usuario);
          $elemento1 = Vacacione::find($request['id']);
           $elemento1->idempleado=$request['idempleado'];
           $elemento1->documento=$request['documento'];
           $elemento1->fecha_desde=$request['fecha_desde'];
           $elemento1->fecha_hasta=$request['fecha_hasta'];
           $elemento1->remunerada=$request['remunerada'];
           $elemento1->observacion=$request['observacion'];
           $elemento1->forma=$request['forma'];
           
           //$elemento1->id_establecimiento=>$user->id_establecimiento;
           if($request["documento_cargar"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/',$request["documento_cargar"]);
           	$elemento1->documento_cargar=$storage_name;
           }
 			
          $elemento1->save();
         return redirect('/All_Vacacione')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Vacacione_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
       	$storage_name="";
       	if($request["documento_cargar"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/', $request["documento_cargar"]);
           }
         Vacacione::create([
           'idempleado'=>$request['idempleado'],
           'documento'=>$request['documento'],
           'fecha'=>$fecha,
           'observacion'=>$request['observacion'],
           'fecha_desde'=>$request['fecha_desde'],
           'fecha_hasta'=>$request['fecha_hasta'],
           "remunerada"=>$request['remunerada'],
           'id_establecimiento'=>$user->id_establecimiento,
           'forma'=>$request['forma'],
           'documento_cargar'=>$storage_name
        ]);

        return redirect('/All_Vacacione')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Vacacione($id,$ruta)
    {
        //
        	
          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        $Empleados=Empleado::all();
        $tipos_nomina = Tipos_nomina::all();
        if($ruta=="actualizar"){
          $ruta ="Vacacione_update";
           $elemento =Vacacione::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Vacacione_create";
          $elemento1 = new stdClass();
          $elemento1->idempleado = "";
          $elemento1->documento ="";
          $elemento1->fecha ="";
          $elemento1->fecha_desde ="";
          $elemento1->fecha_hasta ="";
          $elemento1->idtipoVacacione ="";
          $elemento1->documento_cargar="";
          $elemento1->remunerada="";
          $elemento1->observacion="";
          $elemento1->forma="";
          
          
          $elemento = $elemento1;
        }else{
           $ruta ="All_Vacacione";
           $estilo="none";
           $elemento =Vacacione::find($id);
        }

      return view('thumano.Vacaciones.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,"tipos_nomina"=>$tipos_nomina,
        "Empleados"=>$Empleados,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Vacacione($id)
    {
      Vacacione::destroy($id);
      return redirect('/All_Vacacione')->with('status', "Elemento Eliminado Correctamente");
    }


}
