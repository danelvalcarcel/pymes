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
use App\TipoMotivo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LicenciaController extends Controller
{
    



  protected $nombre_modulo = "Talento Humano";

    public function All_Licencia(Request $request,$sede=null)
    {
        //
       
        $Licencias="";
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

          $Licencias =Licencia::select("*")
            ->join("pyme_empleados","pyme_licencias.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.nombres", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_licencias.id_establecimiento', '=', $user->id_establecimiento)
            ->orWhere("pyme_empleados.apellidos", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_licencias.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
            
            if($sede){
              $Licencias =Licencia::select("*")
            ->join("pyme_empleados","pyme_licencias.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.nombres", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_licencias.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->orWhere("pyme_empleados.apellidos", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_licencias.id_establecimiento', '=', $user->id_establecimiento)
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


             $Licencias =Licencia::select("*")
            ->join("pyme_empleados","pyme_licencias.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], '=',   $campo)
            ->where('pyme_licencias.id_establecimiento', '=', $user->id_establecimiento)

            ->paginate(10);

            if($sede){
               $Licencias =Licencia::select("*")
            ->join("pyme_empleados","pyme_licencias.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], '=',   $campo)
            ->where('pyme_licencias.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->paginate(10);
            }
        }

          else if($request["nombre_campo"]=="documento" && isset($request["busquedad"])==true){
          
          $data_filtro1=$request["nombre_campo"];
          $campo=$request["busquedad"];
          $data_filtro2= $campo;
            $Licencias =Licencia::select("*")
            ->join("pyme_empleados","pyme_licencias.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_licencias.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);

            if($sede){
              $Licencias =Licencia::select("*")
            ->join("pyme_empleados","pyme_licencias.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_licencias.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->paginate(10);
            }

        }


        else{
            $Licencias =Licencia::where("id",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);

            if($sede){
              $Licencias =Licencia::select("*")
            ->join("pyme_empleados","pyme_licencias.idempleado","=","pyme_empleados.idempleado")
            ->where('pyme_licencias.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->paginate(10);
            }
        }
       
       
         return view('thumano.Licencias.home', array("Licencias"=>$Licencias,"title_menu"=>"Licencia",
            "title"=>"Licencias","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo, "cargos"=>$cargos,
            "Centros_trabajos"=>$Centros_trabajos,"sede"=>$sede,"menu"=>$menu,
 "data_filtro1"=>$data_filtro1,"data_filtro2"=>$data_filtro2)); 
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
            if(isset($request['estado'])){
             $elemento1->estado=$request['estado'];
           }
           
           //$elemento1->id_establecimiento=>$user->id_establecimiento;
           if($request["documento_licencia"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/',$request["documento_licencia"]);
           	$elemento1->documento_licencia=$storage_name;
           }
 			
          $elemento1->save();
          if($request['sede']){
 return redirect('/All_Licencia/Sede')->with('status', "Elemento Actualizado Correctamente");
            }else{
 return redirect('/All_Licencia')->with('status', "Elemento Actualizado Correctamente");
            }
        

    }









     public function Licencia_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
       	$storage_name="";
       	if($request["documento_licencia"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/', $request["documento_licencia"]);
           }
           $estado ="No Aprobado";
            if(isset($request['estado'])){
              $estado =$request['estado'];
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
           "estado"=>$estado,
           'id_establecimiento'=>$user->id_establecimiento,
           'documento_licencia'=>$storage_name
        ]);

         if($request['sede']){
return redirect('/All_Licencia/Sede')->with('status', "Elemento Creado Correctamente");
            }else{
return redirect('/All_Licencia')->with('status', "Elemento Creado Correctamente");
            }
        
    }




    public function formulario_Licencia($id,$ruta,  $sede=null)
    {
        //
        	
          $modulos = Modulos::all();
          $Enfermedades =TipoMotivo::all();
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
          $elemento1->estado="";
          $elemento1->observacion="";
          
          
          $elemento = $elemento1;
        }else{
           $ruta ="All_Licencia";
           $estilo="none";
           $elemento =Licencia::find($id);
        }

      return view('thumano.Licencias.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,"tipos_nomina"=>$tipos_nomina,"sede"=>$sede,"menu"=>$menu,
        "Empleados"=>$Empleados,"Enfermedades"=>$Enfermedades,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Licencia(Request $request, $id)
    {
      Licencia::destroy($id);
       if($request['sede']){
return redirect('/All_Licencia/Sede')->with('status', "Elemento Eliminado Correctamente");
            }else{
return redirect('/All_Licencia')->with('status', "Elemento Eliminado Correctamente");
            }
      
    }
}
