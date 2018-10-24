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
use App\Retiro;
use App\Empleado;
use App\Enfermedade;
use App\Empleadosdocumentos;
use App\Empleadospersonas;
use App\TipoMotivo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RetiroController extends Controller
{
    //

     protected $nombre_modulo = "Talento Humano";

    public function All_Retiro(Request $request, $ruta=null)
    {
        //
       
        $Retiros="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
                  $data_filtro1="";
        $data_filtro2="";

      $Centros_trabajos = Centros_trabajo::where('id_establecimiento', '=', $user->id_establecimiento)->get();
       $cargos= Cargo::where('id_establecimiento', '=', $user->id_establecimiento)->get();
               if($ruta){
                $Centros_trabajos = Centros_trabajo::where('id_establecimiento', '=', $user->id_establecimiento)
                ->where("idsede","=",$user->idsede)->get();
       $cargos= Cargo::where('id_establecimiento', '=', $user->id_establecimiento)
       ->where("idsede","=",$user->idsede)->get();
        }
if(isset($request["busquedad"])==true && $request["nombre_campo"]=="nombres"){
             $data_filtro1=$request["nombre_campo"];
          $campo=$request["busquedad"];
          $data_filtro2= $campo;

          $Retiros =Retiro::select("*")
            ->join("pyme_empleados","pyme_retiros.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.nombres", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_retiros.id_establecimiento', '=', $user->id_establecimiento)
            ->orWhere("pyme_empleados.apellidos", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_retiros.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
             if($ruta){
              $Retiros =Retiro::select("*")
            ->join("pyme_empleados","pyme_retiros.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.nombres", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_retiros.id_establecimiento', '=', $user->id_establecimiento)
            ->where('pyme_retiros.idsede', '=', $user->idsede)
            ->orWhere("pyme_empleados.apellidos", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_retiros.id_establecimiento', '=', $user->id_establecimiento)
            ->where('pyme_retiros.idsede', '=', $user->idsede)
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


             $Retiros =Retiro::select("*")
            ->join("pyme_empleados","pyme_retiros.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], '=',   $campo)
            ->where('pyme_retiros.id_establecimiento', '=', $user->id_establecimiento)
            ->where('pyme_retiros.idsede', '=', $user->idsede)
            ->paginate(10);
             
             if($ruta){
              $Retiros =Retiro::select("*")
            ->join("pyme_empleados","pyme_retiros.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], '=',   $campo)
            ->where('pyme_retiros.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
             }
        }

          else if($request["nombre_campo"]=="documento" && isset($request["busquedad"])==true){
          
          $data_filtro1=$request["nombre_campo"];
          $campo=$request["busquedad"];
          $data_filtro2= $campo;
            $Retiros =Retiro::select("*")
            ->join("pyme_empleados","pyme_retiros.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_retiros.id_establecimiento', '=', $user->id_establecimiento)
            ->where('pyme_retiros.idsede', '=', $user->idsede)
            ->paginate(10);
            
            if($ruta){
                          $Retiros =Retiro::select("*")
            ->join("pyme_empleados","pyme_retiros.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_retiros.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
             }

        }


        else{
            $Retiros =Retiro::where("id",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
            if($ruta){
              $Retiros =Retiro::where("id",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->where('pyme_retiros.idsede', '=', $user->idsede)
            ->paginate(10);
             }
        }




        /*if($request["busquedad"]){
            $Retiros = Retiro::where("fecha_desde",">=",$request["busquedad"])
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }else{
            $Retiros = Retiro::where("id",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }
       */
         return view('thumano.Retiros.home', array("Retiros"=>$Retiros,"title_menu"=>"Retiro",
            "title"=>"Retiros","user"=>$user,"Modulos"=>$modulos, "cargos"=>$cargos,
            "Centros_trabajos"=>$Centros_trabajos,
            "nombre_modulo"=>$this->nombre_modulo, "data_filtro1"=>$data_filtro1,"data_filtro2"=>$data_filtro2)); 
    }



    public function Retiro_update(Request $request){

       
          $user = User::find(Auth::user()->id_usuario);
          $elemento1 = Retiro::find($request['id']);
           $elemento1->idempleado=$request['idempleado'];
           $elemento1->documento=$request['documento'];
           $elemento1->fecha_desde=$request['fecha_hasta'];
           $elemento1->fecha_hasta=$request['idempleado'];
           $elemento1->idtipomotivo=$request['idtipomotivo'];
           //$elemento1->id_establecimiento=>$user->id_establecimiento;
           if($request["documento_retiro"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/',$request["documento_retiro"]);
           	$elemento1->documento_retiro=$storage_name;
           }
 			
          $elemento1->save();
         return redirect('/All_Retiro')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Retiro_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
       	$storage_name="";
       	if($request["documento_retiro"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/', $request["documento_retiro"]);
           }
         Retiro::create([
           'idempleado'=>$request['idempleado'],
           'documento'=>$request['documento'],
           'fecha'=>$fecha,
           'fecha_desde'=>$request['fecha_desde'],
           'idtipomotivo'=>$request['idtipomotivo'],
           'id_establecimiento'=>$user->id_establecimiento,
           'idsede'=>$user->idsede,
           'documento_retiro'=>$storage_name
        ]);

        return redirect('/All_Retiro')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Retiro($id,$ruta)
    {
        //
        	
          $modulos = Modulos::all();
          $Motivos =TipoMotivo::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        $Empleados=Empleado::all();
        $tipos_nomina = Tipos_nomina::all();
        if($ruta=="actualizar"){
          $ruta ="Retiro_update";
           $elemento =Retiro::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Retiro_create";
          $elemento1 = new stdClass();
          $elemento1->idempleado = "";
          $elemento1->documento ="";
          $elemento1->fecha ="";
          $elemento1->fecha_desde ="";
          $elemento1->fecha_hasta ="";
          $elemento1->idtipomotivo ="";
          $elemento1->documento_retiro="";
          $elemento1->idsede="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_Retiro";
           $estilo="none";
           $elemento =Retiro::find($id);
        }

      return view('thumano.Retiros.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,"tipos_nomina"=>$tipos_nomina,
        "Empleados"=>$Empleados,"Motivos"=>$Motivos,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Retiro($id)
    {
      Retiro::destroy($id);
      return redirect('/All_Retiro')->with('status', "Elemento Eliminado Correctamente");
    }



}
