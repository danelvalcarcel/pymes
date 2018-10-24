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
use App\Evento;
use App\Empleado;
use App\Enfermedade;
use App\Empleadosdocumentos;
use App\Empleadospersonas;
use App\EventoEmpleado;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventoController extends Controller
{
  
  protected $nombre_modulo = "Talento Humano";

    public function All_Evento(Request $request)
    {
        //
       
        $Eventos="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);

                  $cargos= Cargo::where('id_establecimiento', '=', $user->id_establecimiento)->get();
          $data_filtro1="";
        $data_filtro2="";
      $Centros_trabajos = Centros_trabajo::where('id_establecimiento', '=', $user->id_establecimiento)->get();
if(isset($request["busquedad"])==true && $request["nombre_campo"]=="nombres"){
             $data_filtro1=$request["nombre_campo"];
          $campo=$request["busquedad"];
          $data_filtro2= $campo;

          $Eventos =Evento::select("*")
            ->join("pyme_empleados","pyme_eventos.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.nombres", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_eventos.id_establecimiento', '=', $user->id_establecimiento)
            ->orWhere("pyme_empleados.apellidos", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_eventos.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }
        else if($request["nombre_campo"]=="idcargo"||$request["nombre_campo"]== "idcentro"){
          $campo="";
          $data_filtro1=$request["nombre_campo"];
         
          if($request["nombre_campo"]=="idcargo"){
            $campo =$request["cargo"];
          }else{
            $campo =$request["centro"];
          }
          $data_filtro2= $campo;


             $Eventos =Evento::select("*")
            ->join("pyme_empleados","pyme_eventos.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], '=',   $campo)
            ->where('pyme_eventos.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }

          else if($request["nombre_campo"]=="documento" && isset($request["busquedad"])==true){
          
          $data_filtro1=$request["nombre_campo"];
          $campo=$request["busquedad"];
          $data_filtro2= $campo;
           $Eventos =Evento::select("*")
            ->join("pyme_empleados","pyme_eventos.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_eventos.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);

        }


        else{
            $Eventos =Evento::where("idevento",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }
       
        /*if($request["busquedad"]){
            $Eventos = Evento::where("fecha_desde",">=",$request["busquedad"])
            ->where("fecha_hasta","<=",$request["busquedad"])
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }else{
            $Eventos = Evento::where("idevento",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }*/
       
         return view('thumano.Eventos.home', array("Eventos"=>$Eventos,"title_menu"=>"Evento",
            "title"=>"Eventos","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo,"cargos"=>$cargos,
            "Centros_trabajos"=>$Centros_trabajos,
"data_filtro1"=>$data_filtro1,"data_filtro2"=>$data_filtro2)); 
    }



    public function Evento_update(Request $request){

       
          $user = User::find(Auth::user()->id_usuario);
          $elemento1 = Evento::find($request['id']);
           $elemento1->idempleado=$request['idempleado'];
           $elemento1->fecha_desde=$request['fecha_desde'];
           $elemento1->fecha_hasta=$request['fecha_hasta'];
           $elemento1->remunerada=$request['remunerada'];
           $elemento1->observacion=$request['observacion'];
           $elemento1->forma=$request['forma'];
           $elemento1->nombre=$request['nombre'];
           
           //$elemento1->id_establecimiento=>$user->id_establecimiento;
           if($request["documento_cargar"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/',$request["documento_cargar"]);
           	$elemento1->documento_cargar=$storage_name;
           }

 			
          $elemento1->save();
          for($x=0; $x<6; $x=$x+1){
            if($request['idempleado_'.$x]){
                EventoEmpleado::create(['idevento'=>$elemento1->idevento,
                'idempleado'=>$request['idempleado_'.$x]]);
            }
          }
         return redirect('/All_Evento')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Evento_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
       	$storage_name="";
       	if($request["documento_cargar"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/', $request["documento_cargar"]);
           }
        $evento= Evento::create([
           'nombre'=>$request['nombre'],
           'fecha'=>$fecha,
           'observacion'=>$request['observacion'],
           'fecha_desde'=>$request['fecha_desde'],
           'fecha_hasta'=>$request['fecha_hasta'],
           "remunerada"=>$request['remunerada'],
           'id_establecimiento'=>$user->id_establecimiento,
           'forma'=>$request['forma'],
           'documento_cargar'=>$storage_name
        ]);

         for($x=0; $x<6; $x=$x+1){
            if($request['idempleado_'.$x]){
                EventoEmpleado::create(['idevento'=>$evento->id,
                'idempleado'=>$request['idempleado_'.$x]]);
            }
          }

        return redirect('/All_Evento')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Evento($id,$ruta)
    {
        //
        	
          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        $Empleados=Empleado::all();
        $tipos_nomina = Tipos_nomina::all();
        if($ruta=="actualizar"){
          $ruta ="Evento_update";
           $elemento =Evento::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Evento_create";
          $elemento1 = new stdClass();
          $elemento1->idempleado = "";
          $elemento1->documento ="";
          $elemento1->fecha ="";
          $elemento1->fecha_desde ="";
          $elemento1->fecha_hasta ="";
          $elemento1->idtipoEvento ="";
          $elemento1->documento_cargar="";
          $elemento1->remunerada="";
          $elemento1->observacion="";
          $elemento1->forma="";
          $elemento1->idevento="";
          $elemento1->nombre="";
          
          
          $elemento = $elemento1;
        }else{
           $ruta ="All_Evento";
           $estilo="none";
           $elemento =Evento::find($id);
        }

      return view('thumano.Eventos.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,"tipos_nomina"=>$tipos_nomina,
        "Empleados"=>$Empleados,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Evento($id)
    {
      Evento::destroy($id);
      return redirect('/All_Evento')->with('status', "Elemento Eliminado Correctamente");
    }
}
