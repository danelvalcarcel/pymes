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
use App\CambioAfp;
use App\Empleado;
use App\Enfermedade;
use App\Eps;
use App\Epp;
use App\Empleadosdocumentos;
use App\Empleadospersonas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CambioAfpController extends Controller
{
    



  protected $nombre_modulo = "Talento Humano";

    public function All_CambioAfp(Request $request)
    {
        //
       
        $CambioAfps="";
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

          $CambioAfps =CambioAfp::select("*")
            ->join("pyme_empleados","pyme_incapacidades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.nombres", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_incapacidades.id_establecimiento', '=', $user->id_establecimiento)
            ->orWhere("pyme_empleados.apellidos", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_incapacidades.id_establecimiento', '=', $user->id_establecimiento)
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


             $CambioAfps =CambioAfp::select("*")
            ->join("pyme_empleados","pyme_incapacidades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], '=',   $campo)
            ->where('pyme_incapacidades.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }

          else if($request["nombre_campo"]=="documento" && isset($request["busquedad"])==true){
          
          $data_filtro1=$request["nombre_campo"];
          $campo=$request["busquedad"];
          $data_filtro2= $campo;
            $CambioAfps =CambioAfp::select("*")
            ->join("pyme_empleados","pyme_incapacidades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_incapacidades.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);

        }


        else{
            $CambioAfps =CambioAfp::where("id",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }

        /*if($request["busquedad"]){
            $CambioAfps = CambioAfp::where("fecha_desde",">=",$request["busquedad"])
            ->where("fecha_hasta","<=",$request["busquedad"])
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }else{
            $CambioAfps = CambioAfp::where("id",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }*/
       
         return view('thumano.CambioAfps.home', array("CambioAfps"=>$CambioAfps,"title_menu"=>"CambioAfp",
            "title"=>"Cambio Afp","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo,"cargos"=>$cargos,
            "Centros_trabajos"=>$Centros_trabajos,
"data_filtro1"=>$data_filtro1,"data_filtro2"=>$data_filtro2)); 
    }



    public function CambioAfp_update(Request $request){

       
          $user = User::find(Auth::user()->id_usuario);
          $elemento1 = CambioAfp::find($request['id']);
           $elemento1->idempleado=$request['idempleado'];
           $elemento1->documento=$request['documento'];
           $elemento1->fecha_desde=$request['fecha_desde'];
           $elemento1->fecha_hasta=$request['fecha_hasta'];
           $elemento1->remunerada=$request['remunerada'];
           $elemento1->observacion=$request['observacion'];
           $elemento1->idafp=$request['idafp'];


           
           //$elemento1->id_establecimiento=>$user->id_establecimiento;
           if($request["documento_cargar"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/',$request["documento_cargar"]);
           	$elemento1->documento_cargar=$storage_name;
           }
 			
          $elemento1->save();

          $Empleados=Empleado::find($request['idempleado']);
         $Empleados->liquidarpension =$request['idafp'];
         $Empleados->save();
         return redirect('/All_CambioAfp')->with('status', "Elemento Actualizado Correctamente");

    }









     public function CambioAfp_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
       	$storage_name="";
       	if($request["documento_cargar"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/', $request["documento_cargar"]);
           }
         CambioAfp::create([
           'idempleado'=>$request['idempleado'],
           'documento'=>$request['documento'],
           'fecha'=>$fecha,
           'observacion'=>$request['observacion'],
           'fecha_desde'=>$request['fecha_desde'],
           'fecha_hasta'=>$request['fecha_hasta'],
           "remunerada"=>$request['remunerada'],
           'id_establecimiento'=>$user->id_establecimiento,
           'idafp'=>$request['idafp'],
           'documento_cargar'=>$storage_name
        ]);

         $Empleados=Empleado::find($request['idempleado']);
         $Empleados->liquidarpension =$request['idafp'];
         $Empleados->save();

        return redirect('/All_CambioAfp')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_CambioAfp($id,$ruta)
    {
        //
        	
          $modulos = Modulos::all();
          $Epss = Eps::all();
          $Epps = Epp::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
       $Empleados=Empleado::where('id_establecimiento', '=', $user->id_establecimiento)->get();
        $tipos_nomina = Tipos_nomina::all();
        if($ruta=="actualizar"){
          $ruta ="CambioAfp_update";
           $elemento =CambioAfp::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="CambioAfp_create";
          $elemento1 = new stdClass();
          $elemento1->idempleado = "";
          $elemento1->documento ="";
          $elemento1->fecha ="";
          $elemento1->fecha_desde ="";
          $elemento1->fecha_hasta ="";
          $elemento1->idtipoCambioAfp ="";
          $elemento1->documento_cargar="";
          $elemento1->remunerada="";
          $elemento1->observacion="";
          $elemento1->ideps="";
          $elemento1->idafp="";
          
          
          $elemento = $elemento1;
        }else{
           $ruta ="All_CambioAfp";
           $estilo="none";
           $elemento =CambioAfp::find($id);
        }

      return view('thumano.CambioAfps.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,"tipos_nomina"=>$tipos_nomina,
        "Empleados"=>$Empleados,"Epss"=>$Epss,"Epps"=>$Epps,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_CambioAfp($id)
    {
      CambioAfp::destroy($id);
      return redirect('/All_CambioAfp')->with('status', "Elemento Eliminado Correctamente");
    }


}
