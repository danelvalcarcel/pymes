<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Epp;
use App\Eps;
use App\Modulos;
use App\Entidad;
use App\Tipos_nomina;
use App\Cargo;
use App\CajaCompensacion;
use App\Centros_trabajo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Empleado;
use App\Empleadosdocumentos;
use App\Empleadospersonas;
use App\Tipo_documento;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
class EmpleadoController extends Controller
{
    //
  protected $tipo_documentos=["Seleccione una Opcion","Cedula","Manipulacion Alimentos","Pasaporte","Experiencia"];
  protected $tipoparentesco=["Seleccione una Opcion","Esposo(a)","Pareja","Hijo(a)","Padre o Madre",
                            "Hermano(a)","Tio(a)","Abuelo(a)","Primo(a)","Suegro(a)","Otro"];
  protected $generos=["Femenino", "Masculino"];

  protected $data_export = "";
  protected $nombre_modulo = "Maestros";
   public function All_Empleado(Request $request)
    {
        //
        
         $data_filtro1="";
         $data_filtro2="";
        
        $empleados="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
          $establecimiento="";
          $operador="";
         if($user->role==2){
          $establecimiento = 0;
          $operador=">";
         }else{
          $operador="=";
        $establecimiento = $user->id_establecimiento;   
         }
        
         $cargos= Cargo::where('id_establecimiento', $operador, $establecimiento)->get();
        $Centros_trabajos = Centros_trabajo::where('id_establecimiento', $operador, $establecimiento)->get();
        if(isset($request["busquedad"])==true && $request["nombre_campo"]=="nombres"){
             $data_filtro1=$request["nombre_campo"];
          $campo=$request["busquedad"];
          $data_filtro2= $campo;
            $empleados = Empleado::where('nombres', 'like', '%' . $request["busquedad"] . '%')
            ->where('id_establecimiento', $operador, $establecimiento)
            ->orwhere('apellidos', 'like', '%' . $request["busquedad"] . '%')
            ->where('id_establecimiento', $operador, $establecimiento)
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
            $empleados = Empleado::where($request["nombre_campo"], '=', $campo)
            ->where('id_establecimiento', $operador, $establecimiento)
            ->paginate(10);
        }

          else if($request["nombre_campo"]=="documento" && isset($request["busquedad"])==true){
          
          $data_filtro1=$request["nombre_campo"];
          $campo=$request["busquedad"];
          $data_filtro2= $campo;
            $empleados =Empleado::where($request["nombre_campo"], 'like', '%' . $request["busquedad"] . '%')
            ->where('id_establecimiento', $operador, $establecimiento)
            ->paginate(10);

        }
        else if($request["campo"] && $request["id"]){
          $data_filtro1=$request["campo"];
          $data_filtro2=$request["id"];
            $empleados = Empleado::where($request["campo"],"=",$request["id"])
            ->where('id_establecimiento', $operador, $establecimiento)
            ->paginate(10);
        }

        else{
            $empleados = Empleado::where("idempleado",">",0)
            ->where('id_establecimiento', $operador, $establecimiento)
            ->paginate(10);
        }
         return view('thumano.Empleado.home', array("empleados"=>$empleados,"title_menu"=>"Empleado",
            "title"=>"Empleados","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo,"cargos"=>$cargos,
            "Centros_trabajos"=>$Centros_trabajos,
            "data_filtro1"=>$data_filtro1,"data_filtro2"=>$data_filtro2)); 
        

        
    }


    public function Report_Empleado(Request $request){


          $cargos= Cargo::All();
         $Centros_trabajos = Centros_trabajo::All();
        $empleados="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
         $establecimiento="";
          $operador="";
         if($user->role==2){
          $establecimiento = true;
         }else{
             $operador="=";
        $establecimiento = $user->id_establecimiento;   
         }
        if($request["busquedad"]){
            $empleados = Empleado::where('nombres', 'like', '%' . $request["busquedad"] . '%')
            ->where('id_establecimiento', $operador, $establecimiento)
            ->orwhere('apellidos', 'like', '%' . $request["busquedad"] . '%')
            ->where('id_establecimiento', $operador, $establecimiento)
            ->get();
        }
        else if($request["nombre_campo"]=="idcargo"||$request["nombre_campo"]== "idcentro"){
          $campo="";
          if($request["nombre_campo"]=="idcargo"){
            $campo =$request["cargo"];
          }else{
            $campo =$request["centro"];
          }
            $empleados = Empleado::where($request["nombre_campo"], '=', $campo)
            ->where('id_establecimiento', $operador, $establecimiento)
            ->get();
        }
        else if($request["campo"] && $request["id"]){
            $empleados = Empleado::where($request["campo"],"=",$request["id"])
            ->where('id_establecimiento', $operador, $establecimiento)
            ->get();
        }

        else{
            $empleados = Empleado::where("idEmpleado",">",0)
            ->where('id_establecimiento', $operador, $establecimiento)
            ->get();
        }
          if($request["reporte"]=="PDF"){
          $pdf = PDF::loadView('thumano.Empleado.report_pdf', ['empleados' => $empleados]);
               $pdf->getDomPDF()->set_option('enable_html5_parser', true);
                return $pdf->download('document.pdf');
              }
              if($request["reporte"]=="EXCEL"){
                  Excel::create('Informe Sintec', function($excel) use ($empleados) {
 
            $excel->sheet('Empleados', function($sheet) use ($empleados) {

              $sheet->row(2, [
                  '',"", 'INFORME EMPLEADOS SINTEC', '', '', ''
              ]);
              $sheet->row(3, [
                  'Doc',"Fecha Ingreso", 'Nombre', 'Cargo', 'Centro', 'Sueldo'
              ]);
              foreach($empleados as $index => $empleado) {
                  $sheet->row($index+4, [
                      $empleado->documento, $empleado->fecha_ingreso,
                       $empleado->nombres, $empleado->Cargo->nombre,
                        $empleado->Centro_trabajo->nombre,
                        number_format($empleado->sueldo, 0, ',', '.')
                  ]); 
              }
 
            });
        })->export('xls');
              }else {
                return redirect("/All_Empleado");
              }

 
              
    }

    public function Empleado_update(Request $request){

       
         $user = User::find(Auth::user()->id_usuario);
          $elemento1 = Empleado::find($request['id']);
          $elemento1->contrato=$request['contrato'];
            $elemento1->documento=$request['documento'];
            $elemento1->ideps=0;
            $elemento1->idpension=0;
            $elemento1->idtiponomina=$request['idtiponomina'];
            $elemento1->idcentro=$request['idcentro'];
            $elemento1->fecha_nacimiento=$request['fecha_nacimiento'];
            $elemento1->fecha_ingreso=$request['fecha_ingreso'];
            $elemento1->fecha_terminacion=$request['fecha_terminacion'];
            $elemento1->fondo=$request['fondo'];
            $elemento1->nombres=$request['nombres'];
            $elemento1->apellidos=$request['apellidos'];
            $elemento1->direccion=$request['direccion'];
            $elemento1->telefono=$request['telefono'];
            $elemento1->liquidarsalud=$request['liquidarsalud'];
            $elemento1->liquidarpension=$request['liquidarpension'];
            $elemento1->idcargo=$request['idcargo'];
            $elemento1->genero=$request['genero'];
            $elemento1->idempresa=$user->id_establecimiento;
            $elemento1->nivelestudios=$request['nivelestudios'];
            $elemento1->idprofesion=0;
            $elemento1->id_establecimiento=$user->id_establecimiento;
            $elemento1->sueldo=$request['sueldo'];
            $elemento1->talla_camisa=$request['talla_camisa'];
            $elemento1->talla_pantalon=$request['talla_pantalon'];
            $elemento1->talla_zapatos=$request['talla_zapatos'];
            $elemento1->rh=$request['rh'];
          
          $elemento1->save();
          //Empleadosdocumentos
          //Empleadospersonas

          for($x=1; $x<6; $x=$x+1){
            if($request['docuemnto_a_cargo_'.$x]){
                Empleadospersonas::create(['idempleado'=>$elemento1->idempleado,
                'documento'=>$request['docuemnto_a_cargo_'.$x],
                'nombres'=>$request['nombres_a_cargo_'.$x],
                'apellidos'=>$request['apellidos_a_cargo_'.$x],
                'fechanacimeinto'=>$request['fecha_nacimiento_a_cargo_'.$x],
                'genero'=>$request['genero_a_cargo_'.$x],
                'tipoparentesco'=>$request['tipoparentesco_a_cargo_'.$x]]);
            }
          }

          for($x=1; $x<6; $x=$x+1){
               
                $name_prev  =  $_FILES["file_load_".$x]["name"];
                $tmp = explode(".", $name_prev);
                $ext = end($tmp);
                $name_archivo =$x."--".time()."-".rand().$x.".".$ext;
            if($request['tipo_documento_'.$x]!=""){
              $storage_name =Storage::disk('public_empleados')->put("/",$request["file_load_".$x]);
                Empleadosdocumentos::create([
                'idempleado'=>$elemento1->idempleado,
                'idtipodocumento'=>$request['tipo_documento_'.$x],
                "nombre"=> $storage_name,
                'fecha_vencimiento'=>$request['fecha_vencimiento_'.$x]]);
                
            }
          }
         
         return redirect('/All_Empleado')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Empleado_create(Request $request){


        $user = User::find(Auth::user()->id_usuario);
        $elemento1= Empleado::create([
            
            'contrato'=>$request['contrato'],
            'documento'=>$request['documento'],
            'ideps'=>0,
            'idpension'=>0,
            'idtiponomina'=>$request['idtiponomina'],
            'idcentro'=>$request['idcentro'],
            'fecha_nacimiento'=>$request['fecha_nacimiento'],
            'fecha_ingreso'=>$request['fecha_ingreso'],
            'fecha_terminacion'=>$request['fecha_terminacion'],
            'fondo'=>$request['fondo'],
            'nombres'=>$request['nombres'],
            'apellidos'=>$request['apellidos'],
            'direccion'=>$request['direccion'],
            'telefono'=>$request['telefono'],
            'liquidarsalud'=>$request['liquidarsalud'],
            'liquidarpension'=>$request['liquidarpension'],
            'idcargo'=>$request['idcargo'],
            'genero'=>$request['genero'],
            'idempresa'=>$user->id_establecimiento,
            'nivelestudios'=>$request['nivelestudios'],
            'idprofesion'=>0,
            'id_establecimiento'=>$user->id_establecimiento,
            "sueldo"=>$request['sueldo'],
            "talla_camisa"=>$request['talla_camisa'],
            "talla_pantalon"=>$request['talla_pantalon'],
            "talla_zapatos"=>$request['talla_zapatos'],
            "rh"=>$request['rh']
        ]);

          for($x=1; $x<6; $x=$x+1){
            if($request['docuemnto_a_cargo_'.$x]){
                Empleadospersonas::create(['idempleado'=>$elemento1->idempleado,
                'documento'=>$request['docuemnto_a_cargo_'.$x],
                'nombres'=>$request['nombres_a_cargo_'.$x],
                'apellidos'=>$request['apellidos_a_cargo_'.$x],
                'fechanacimeinto'=>$request['fecha_nacimiento_a_cargo_'.$x],
                'genero'=>$request['genero_a_cargo_'.$x],
                'tipoparentesco'=>$request['tipoparentesco_a_cargo_'.$x]]);
            }
          }

          for($x=1; $x<6; $x=$x+1){
               
                $name_prev  =  $_FILES["file_load_".$x]["name"];
                $tmp = explode(".", $name_prev);
                $ext = end($tmp);
                $name_archivo =$x."--".time()."-".rand().$x.".".$ext;
            if($request['tipo_documento_'.$x]){
              $storage_name =Storage::disk('public_empleados')->put("/",$request["file_load_".$x]);
                Empleadosdocumentos::create([
                'idempleado'=>$elemento1->idempleado,
                'idtipodocumento'=>$request['tipo_documento_'.$x],
                "nombre"=> $storage_name,
                'fecha_vencimiento'=>$request['fecha_vencimiento_'.$x]]);
                
            }
          }

        return redirect('/All_Empleado')->with('status', "Elemento Creado Correctamente");
    }

     public function Certificado_Empleado($id){
       $user = Empleado::find($id);
        $pdf = PDF::loadView('thumano.Empleado.certificado', ['user' => $user]);
        $pdf->getDomPDF()->set_option('enable_html5_parser', true);
        return $pdf->download('document.pdf');

     }
    


    public function formulario_Empleado($id,$ruta)
    {
        //
        $cajas =CajaCompensacion::all();
       $all_tipo_documento=Tipo_documento::all();
          $Epss = Eps::all();
          $Epps = Epp::all();
          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $cargos=	Cargo::where('id_establecimiento', "=", $user->id_establecimiento)
        ->get();
		       $Centros_trabajos = Centros_trabajo::where('id_establecimiento', "=", $user->id_establecimiento)
        ->get();

           $establecimiento="";
          $operador="";
         if($user->role==2){
          $establecimiento = 0;
          $operador=">";
         }else{
          $operador="=";
        $establecimiento = $user->id_establecimiento;   
         }
        
           $estilo="";
        $elemento="";
        $tipos_nomina = Tipos_nomina::where('id_establecimiento', "=", $user->id_establecimiento)
        ->get();
        if($ruta=="actualizar"){
          $ruta ="Empleado_update";
           $elemento =Empleado::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Empleado_create";
          $elemento1 = new stdClass();
          $elemento1->contrato = "";
          $elemento1->documento = "";
          $elemento1->ideps = "";
          $elemento1->idpension = "";
          $elemento1->idtiponomina = "";
          $elemento1->idcentro = "";
          $elemento1->fecha_nacimiento = "";
          $elemento1->fecha_ingreso = "";
          $elemento1->fecha_terminacion = "";
          $elemento1->fondo = "";
          $elemento1->nombres = "";
          $elemento1->apellidos = "";
          $elemento1->direccion = "";
          $elemento1->telefono = "";
          $elemento1->liquidarsalud = "";
          $elemento1->liquidarpension = "";
          $elemento1->idcargo = "";
          $elemento1->genero = "";
          $elemento1->personas = [];
          $elemento1->documentos = [];
          $elemento1->idempresa = "";
          $elemento1->nivelestudios = "";
          $elemento1->idprofesion = "";
          $elemento1->sueldo = "";
          $elemento1->id_establecimiento = "";
          $elemento1->idcajadecompensacion="";
          $elemento1->talla_camisa="";
          $elemento1->talla_pantalon="";
          $elemento1->talla_zapatos="";
          $elemento1->rh="";

          
          
          $elemento = $elemento1;
        }else{
           $ruta ="All_Empleado";
           $estilo="none";
           $elemento =Empleado::find($id);
        }

      return view('thumano.Empleado.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,"tipos_nomina"=>$tipos_nomina,"generos"=>$this->generos,"Epps"=>$Epps,"Epss"=>$Epss,
		    "cargos"=>$cargos,"tipos_docs"=>$this->tipo_documentos,"tipoparentesco"=>$this->tipoparentesco,
			"Centros_trabajos"=>$Centros_trabajos,"all_tipo_documento"=>$all_tipo_documento,"Cajas"=>$cajas,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Empleado($id)
    {
      Empleado::destroy($id);
      return redirect('/All_Empleado')->with('status', "Elemento Eliminado Correctamente");
    }
 
}
