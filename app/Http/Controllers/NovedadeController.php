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
use App\Novedade;
use App\Empleado;
use App\Enfermedade;
use App\Empleadosdocumentos;
use App\Empleadospersonas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
class NovedadeController extends Controller
{
   


  protected $nombre_modulo = "Talento Humano";
  protected $tipos=["Negativa", "Positiva"];
    public function All_Novedade(Request $request, $sede=null)
    {

        $Novedades="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        $cargos= Cargo::where('id_establecimiento', '=', $user->id_establecimiento)->get();
        $data_filtro1="";
        $data_filtro2="";
      $Centros_trabajos = Centros_trabajo::where('id_establecimiento', '=', $user->id_establecimiento)->get();
       $menu ="layouts.menu.thumano.admin";
         if($sede){
          $menu ="layouts.menu.sedes.admin";
          $this->nombre_modulo="Sedes";
        }
if(isset($request["busquedad"])==true && $request["nombre_campo"]=="nombres"){
             $data_filtro1=$request["nombre_campo"];
          $campo=$request["busquedad"];
          $data_filtro2= $campo;

          $Novedades =Novedade::select("*")
            ->join("pyme_empleados","pyme_novedades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.nombres", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->orwhere("pyme_empleados.apellidos", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);

             if($sede){
               $Novedades =Novedade::select("*")
            ->join("pyme_empleados","pyme_novedades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.nombres", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->orwhere("pyme_empleados.apellidos", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
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
            /*$Novedades =Novedade::with("empleado")->where("empleado.".$request["nombre_campo"], '=', $campo)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);*/

             $Novedades =Novedade::select("*")
            ->join("pyme_empleados","pyme_novedades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], '=',   $campo)
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);

            if($sede){
              $Novedades =Novedade::select("*")
            ->join("pyme_empleados","pyme_novedades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], '=',   $campo)
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->paginate(10);
              
             }
        }

          else if($request["nombre_campo"]=="documento" && isset($request["busquedad"])==true){
          
          $data_filtro1=$request["nombre_campo"];
          $campo=$request["busquedad"];
          $data_filtro2= $campo;
            $Novedades =Novedade::select("*")
            ->join("pyme_empleados","pyme_novedades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);


            if($sede){

              $Novedades =Novedade::select("*")
            ->join("pyme_empleados","pyme_novedades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->paginate(10);
             }

        }


        else{
            $Novedades =Novedade::where("id",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);


            if($sede){
              $Novedades =Novedade::select("*")
            ->join("pyme_empleados","pyme_novedades.idempleado","=","pyme_empleados.idempleado")
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->paginate(10);
              
             }
        }
       
         return view('thumano.Novedades.home', array("Novedades"=>$Novedades,"title_menu"=>"Novedade",
            "title"=>"Novedades","user"=>$user,"Modulos"=>$modulos,"cargos"=>$cargos,
            "Centros_trabajos"=>$Centros_trabajos,"menu"=>$menu,"sede"=>$sede,
            "nombre_modulo"=>$this->nombre_modulo,"tipos"=>$this->tipos,
            "data_filtro1"=>$data_filtro1,"data_filtro2"=>$data_filtro2)); 
    }





        public function Report_Novedade(Request $request){


          

                  $Novedades="";
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

          $Novedades =Novedade::select("*")
            ->join("pyme_empleados","pyme_novedades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.nombres", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->orwhere("pyme_empleados.apellidos", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->get();

             if($request["sede_expor"]){
              $Novedades =Novedade::select("*")
            ->join("pyme_empleados","pyme_novedades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.nombres", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->orwhere("pyme_empleados.apellidos", 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->get();
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


             $Novedades =Novedade::select("*")
            ->join("pyme_empleados","pyme_novedades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], '=',   $campo)
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->get();


                         if($request["sede_expor"]){
                          $Novedades =Novedade::select("*")
            ->join("pyme_empleados","pyme_novedades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], '=',   $campo)
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->get();
             }
        }

          else if($request["nombre_campo"]=="documento" && isset($request["busquedad"])==true){
          
          $data_filtro1=$request["nombre_campo"];
          $campo=$request["busquedad"];
          $data_filtro2= $campo;
            $Novedades =Novedade::select("*")
            ->join("pyme_empleados","pyme_novedades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->get();


                         if($request["sede_expor"]){
                          $Novedades =Novedade::select("*")
            ->join("pyme_empleados","pyme_novedades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], 'like', '%' . $request["busquedad"] . '%')
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->get();
             }

        }
        /*else if($request["campo"] && $request["id"]){

           $Novedades =Novedade::select("*")
            ->join("pyme_empleados","pyme_novedades.idempleado","=","pyme_empleados.idempleado")
            ->where("pyme_empleados.".$request["nombre_campo"], '=',   $request["id"])
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->get();
           
        }*/

        else{
            $Novedades =Novedade::where("id",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->get();


                         if($request["sede_expor"]){
                          $Novedades =Novedade::select("*")
            ->join("pyme_empleados","pyme_novedades.idempleado","=","pyme_empleados.idempleado")
            ->where('pyme_novedades.id_establecimiento', '=', $user->id_establecimiento)
            ->where("pyme_empleados.idcentro", '=',$user->idcentro)
            ->get();
             }
        }
     


          if($request["reporte"]=="PDF"){
          $pdf = PDF::loadView('thumano.Novedades.report_pdf', array('novedades' => $Novedades,
            "tipos"=>$this->tipos));
               $pdf->getDomPDF()->set_option('enable_html5_parser', true);
                return $pdf->download('document.pdf');
              }
              if($request["reporte"]=="EXCEL"){
                  Excel::create('Informe Sintec', function($excel) use ($Novedades) {
 
            $excel->sheet('Empleados', function($sheet) use ($Novedades) {

              $sheet->row(2, [
                  '',"", 'INFORME NOVEDADES SINTEC', '', '', ''
              ]);
              $sheet->row(3, [
                  'Doc','Nombre', "Fecha", 'Cargo', 'Centro', 'Tipo'
              ]);
              foreach($Novedades as $index => $novedade) {
                  $sheet->row($index+4, [
                      $novedade->empleado->documento,
                       $novedade->empleado->nombres." ".$novedade->empleado->apellidos,
                        $novedade->fecha_desde,
                        $novedade->empleado->Cargo->nombre,
                        $novedade->empleado->Centro_trabajo->nombre,
                        $this->tipos[$novedade->forma]
                  ]); 
              }
 
            });
        })->export('xls');
              }else {
                return redirect("/All_Novedade");
              }

 
              
    }












    public function Novedade_update(Request $request){

       
          $user = User::find(Auth::user()->id_usuario);
          $elemento1 = Novedade::find($request['id']);
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


           if($request['sede']){
           return redirect('/All_Novedade/Sede')->with('status', "Elemento Actualizado Correctamente");
         }else{
         return redirect('/All_Novedade')->with('status', "Elemento Actualizado Correctamente");
         }
         

    }









     public function Novedade_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
       	$storage_name="";
       	if($request["documento_cargar"]){
           	$storage_name =Storage::disk('public_incapacidades')->put('/', $request["documento_cargar"]);
           }
         Novedade::create([
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
          if($request['sede']){
           return redirect('/All_Novedade/Sede')->with('status', "Elemento Creado Correctamente");
         }else{
        return redirect('/All_Novedade')->with('status', "Elemento Creado Correctamente");
         }
        
    }




    public function formulario_Novedade($id,$ruta, $sede=null)
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
          $ruta ="Novedade_update";
           $elemento =Novedade::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Novedade_create";
          $elemento1 = new stdClass();
          $elemento1->idempleado = "";
          $elemento1->documento ="";
          $elemento1->fecha ="";
          $elemento1->fecha_desde ="";
          $elemento1->fecha_hasta ="";
          $elemento1->idtipoNovedade ="";
          $elemento1->documento_cargar="";
          $elemento1->remunerada="";
          $elemento1->observacion="";
          $elemento1->forma="";
          
          
          $elemento = $elemento1;
        }else{
           $ruta ="All_Novedade";
           $estilo="none";
           $elemento =Novedade::find($id);
        }

      return view('thumano.Novedades.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,"tipos_nomina"=>$tipos_nomina,"menu"=>$menu,"sede"=>$sede,
        "Empleados"=>$Empleados,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Novedade($id)
    {
      Novedade::destroy($id);
      if($request['sede']){
           return redirect('/All_Novedade/Sede')->with('status', "Elemento Eliminado Correctamente");
         }else{
      return redirect('/All_Novedade')->with('status', "Elemento Eliminado Correctamente");
         }
      
    }


}
