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
use App\Incapacidade;
use App\Empleado;
use App\Enfermedade;
use App\TipoMotivo;
use App\Empleadosdocumentos;
use App\Empleadospersonas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;


class IncapacidadeController extends Controller
{
    //

  protected $nombre_modulo = "Talento Humano";

    public function All_Incapacidade(Request $request)
    {
        //
       
        $Incapacidades="";
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

          $Incapacidades =Incapacidade::select("*")
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


             $Incapacidades =Incapacidade::select("*")
            ->join("pyme_empleados","pyme_incapacidades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], '=',   $campo)
            ->where('pyme_incapacidades.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }

          else if($request["nombre_campo"]=="documento" && isset($request["busquedad"])==true){
          
          $data_filtro1=$request["nombre_campo"];
          $campo=$request["busquedad"];
          $data_filtro2= $campo;
            $Incapacidades =Incapacidade::select("*")
            ->join("pyme_empleados","pyme_incapacidades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_incapacidades.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);

        }


        else{
            $Incapacidades =Incapacidade::where("id",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }
       
         return view('thumano.Incapacidades.home', array("Incapacidades"=>$Incapacidades,"title_menu"=>"Incapacidade",
            "title"=>"Incapacidades","user"=>$user,"Modulos"=>$modulos,
            "cargos"=>$cargos,
            "Centros_trabajos"=>$Centros_trabajos,
            "nombre_modulo"=>$this->nombre_modulo, "data_filtro1"=>$data_filtro1,"data_filtro2"=>$data_filtro2)); 
    }








        public function Report_Incapacidade(Request $request){


          

                   $Incapacidades="";
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

          $Incapacidades =Incapacidade::select("*")
            ->join("pyme_empleados","pyme_incapacidades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.nombres", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_incapacidades.id_establecimiento', '=', $user->id_establecimiento)
            ->orwhere("pyme_empleados.apellidos", 'like', '%' . $request["busquedad"] . '%')
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


             $Incapacidades =Incapacidade::select("*")
            ->join("pyme_empleados","pyme_incapacidades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], '=',   $campo)
            ->where('pyme_incapacidades.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }

          else if($request["nombre_campo"]=="documento" && isset($request["busquedad"])==true){
          
          $data_filtro1=$request["nombre_campo"];
          $campo=$request["busquedad"];
          $data_filtro2= $campo;
            $Incapacidades =Incapacidade::select("*")
            ->join("pyme_empleados","pyme_incapacidades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_incapacidades.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);

        }


        else{
            $Incapacidades =Incapacidade::where("id",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }
          if($request["reporte"]=="PDF"){
          $pdf = PDF::loadView('thumano.Incapacidades.report_pdf', array('incapacidades' => $Incapacidades));
               $pdf->getDomPDF()->set_option('enable_html5_parser', true);
                return $pdf->download('document.pdf');
              }
              if($request["reporte"]=="EXCEL"){
                  Excel::create('Informe Sintec', function($excel) use ($Incapacidades) {
 
            $excel->sheet('Empleados', function($sheet) use ($Incapacidades) {

              $sheet->row(2, [
                  '',"", 'INFORME INCAPACIDADES SINTEC', '', '', ''
              ]);
              $sheet->row(3, [
                  'Doc','Nombre', "Fecha Desde", "Fecha Desde", 'Cargo', 'Centro', 'Motivo'
              ]);
              foreach($Incapacidades as $index => $incapacidade) {
                  $sheet->row($index+4, [
                      $incapacidade->empleado->documento,
                       $incapacidade->empleado->nombres." ".$incapacidade->empleado->apellidos,
                        $incapacidade->fecha_desde,
                        $incapacidade->fecha_hasta,
                        $incapacidade->empleado->Cargo->nombre,
                        $incapacidade->empleado->Centro_trabajo->nombre,
                        $incapacidade->TipoMotivo->nombre
                  ]); 
              }
 
            });
        })->export('xls');
              }else {
                return redirect("/All_Novedade");
              }

 
              
    }












    public function Incapacidade_update(Request $request){

       
          $user = User::find(Auth::user()->id_usuario);
          $elemento1 = Incapacidade::find($request['id']);
           $elemento1->idempleado=$request['idempleado'];
           $elemento1->documento=$request['documento'];
           $elemento1->fecha_desde=$request['fecha_desde'];
           $elemento1->fecha_hasta=$request['fecha_hasta'];
           $elemento1->idtipoenfermedad=$request['idtipoenfermedad'];
           $elemento1->idtipomotivo=$request['idtipomotivo'];

           //$elemento1->id_establecimiento=>$user->id_establecimiento;
           if($request["documento_incapacidad"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/',$request["documento_incapacidad"]);
           	$elemento1->documento_incapacidad=$storage_name;
           }
 			
          $elemento1->save();
         return redirect('/All_Incapacidade')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Incapacidade_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
       	$storage_name="";
       	if($request["documento_incapacidad"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/', $request["documento_incapacidad"]);
           }
         Incapacidade::create([
           'idempleado'=>$request['idempleado'],
           'documento'=>$request['documento'],
           'fecha'=>$fecha,
           'fecha_desde'=>$request['fecha_desde'],
           'fecha_hasta'=>$request['fecha_hasta'],
           'idtipoenfermedad'=>$request['idtipoenfermedad'],
           'id_establecimiento'=>$user->id_establecimiento,
           'documento_incapacidad'=>$storage_name,
           "idtipomotivo"=>$request['idtipomotivo']
        ]);

        return redirect('/All_Incapacidade')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Incapacidade($id,$ruta)
    {
        //
        	
          $modulos = Modulos::all();
          
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        $Motivos=TipoMotivo::where('id_establecimiento', '=', $user->id_establecimiento)->get();
        $Enfermedades =Enfermedade::where('id_establecimiento', '=', $user->id_establecimiento)->get();
        $Empleados=Empleado::all();
        $tipos_nomina = Tipos_nomina::all();
        if($ruta=="actualizar"){
          $ruta ="Incapacidade_update";
           $elemento =Incapacidade::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Incapacidade_create";
          $elemento1 = new stdClass();
          $elemento1->idempleado = "";
          $elemento1->documento ="";
          $elemento1->fecha ="";
          $elemento1->fecha_desde ="";
          $elemento1->fecha_hasta ="";
          $elemento1->idtipoenfermedad ="";
          $elemento1->documento_incapacidad="";
          $elemento1->idtipomotivo="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_Incapacidade";
           $estilo="none";
           $elemento =Incapacidade::find($id);
        }

      return view('thumano.Incapacidades.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,"tipos_nomina"=>$tipos_nomina,"Motivos"=>$Motivos,
        "Empleados"=>$Empleados,"Enfermedades"=>$Enfermedades,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Incapacidade($id)
    {
      Incapacidade::destroy($id);
      return redirect('/All_Incapacidade')->with('status', "Elemento Eliminado Correctamente");
    }

}
