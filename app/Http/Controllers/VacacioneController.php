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

    public function All_Vacacione(Request $request,$sede=null)
    {
        //
       
        $Vacaciones="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        
                  $cargos= Cargo::where('id_establecimiento', '=', $user->id_establecimiento)->get();
          $data_filtro1="";
        $data_filtro2="";
      $Centros_trabajos = Centros_trabajo::where('id_establecimiento', '=', $user->id_establecimiento)->get();
      $menu ="layouts.menu.thumano.admin";
         if($sede){
          $this->nombre_modulo="Sedes";
          $menu ="layouts.menu.sedes.admin";
        }
if(isset($request["busquedad"])==true && $request["nombre_campo"]=="nombres"){
             $data_filtro1=$request["nombre_campo"];
          $campo=$request["busquedad"];
          $data_filtro2= $campo;

          $Vacaciones =Vacacione::select("*")
            ->join("pyme_empleados","pyme_vacaciones.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.nombres", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_vacaciones.id_establecimiento', '=', $user->id_establecimiento)
            ->orWhere("pyme_empleados.apellidos", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_vacaciones.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
            
            if($sede){

               $Vacaciones =Vacacione::select("*")
            ->join("pyme_empleados","pyme_vacaciones.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.nombres", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_vacaciones.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->orWhere("pyme_empleados.apellidos", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_vacaciones.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->paginate(10);
            }
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


             $Vacaciones =Vacacione::select("*")
            ->join("pyme_empleados","pyme_vacaciones.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], '=',   $campo)
            ->where('pyme_vacaciones.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);

            if($sede){

               $Vacaciones =Vacacione::select("*")
            ->join("pyme_empleados","pyme_vacaciones.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], '=',   $campo)
            ->where('pyme_vacaciones.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->paginate(10);
            }
        }

          else if($request["nombre_campo"]=="documento" && isset($request["busquedad"])==true){
          
          $data_filtro1=$request["nombre_campo"];
          $campo=$request["busquedad"];
          $data_filtro2= $campo;
            $Vacaciones =Vacacione::select("*")
            ->join("pyme_empleados","pyme_vacaciones.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_vacaciones.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);


            if($sede){

               $Vacaciones =Vacacione::select("*")
            ->join("pyme_empleados","pyme_vacaciones.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_vacaciones.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->paginate(10);
            }

        }


        else{
            $Vacaciones =Vacacione::where("id",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);

            if($sede){

               $Vacaciones =Vacacione::select("*")
            ->join("pyme_empleados","pyme_vacaciones.idempleado","=","pyme_empleados.idempleado")
            ->where('pyme_vacaciones.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->paginate(10);
            }
        }

       
         return view('thumano.Vacaciones.home', array("Vacaciones"=>$Vacaciones,"title_menu"=>"Vacacione",
            "title"=>"Vacaciones","user"=>$user,"Modulos"=>$modulos,"cargos"=>$cargos,"sede"=>$sede,"menu"=>$menu,
            "Centros_trabajos"=>$Centros_trabajos,"data_filtro1"=>$data_filtro1,"data_filtro2"=>$data_filtro2,
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

          if($sede){
return redirect('/All_Vacacione/Sede')->with('status', "Elemento Actualizado Correctamente");
            }else{
return redirect('/All_Vacacione')->with('status', "Elemento Actualizado Correctamente");
            }
      
    
         

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

         if($sede){
   return redirect('/All_Vacacione/Sede')->with('status', "Elemento Creado Correctamente");
            }else{
   return redirect('/All_Vacacione')->with('status', "Elemento Creado Correctamente");
            }
      
    
     
    }




    public function formulario_Vacacione($id,$ruta,$sede=null)
    {
        //
        	
          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
         $Empleados=Empleado::where('id_establecimiento', '=', $user->id_establecimiento)->get();
        $tipos_nomina = Tipos_nomina::all();
         $menu ="layouts.menu.thumano.admin";
         if($sede){
          $this->nombre_modulo="Sedes";
          $menu ="layouts.menu.sedes.admin";
           $Empleados=Empleado::where('id_establecimiento', '=', $user->id_establecimiento)
                ->where("idcentro","=",$user->idcentro)->get();
        }
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
        "estilo"=>$estilo,"tipos_nomina"=>$tipos_nomina,"sede"=>$sede,"menu"=>$menu,
        "Empleados"=>$Empleados,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Vacacione($id)
    {
      Vacacione::destroy($id);
      if($sede){
return redirect('/All_Vacacione/Sede')->with('status', "Elemento Eliminado Correctamente");
            }else{
return redirect('/All_Vacacione')->with('status', "Elemento Eliminado Correctamente");
            }
      
    
     
    }


}
