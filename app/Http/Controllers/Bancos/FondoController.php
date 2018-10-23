<?php

namespace App\Http\Controllers\Bancos;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use App\Arl;
use App\Maestros\Categoria;
use App\Maestros\Medida;
use App\Maestros\Puc;
use App\Maestros\Banco;
use App\Bancos\Fondo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FondoController extends Controller
{
    




     protected $nombre_modulo = "Bancos";

      public function All_Fondo(Request $request)
    {
        //
       
        $Fondos="";
        $Categorias=Categoria::all();
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Fondos = Fondo::where("nombre","=",$request["busquedad"])
            ->where("isDeleted","<>",1)
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->where("isDeleted","<>",1)
            ->paginate(10);

        }else{
            $Fondos = Fondo::where("id_fondo",">",0)
            ->where("isDeleted","<>",1)
            ->paginate(10);
        }
       
         return view('bancos.Fondos.home', array("Fondos"=>$Fondos,"title_menu"=>"Fondo",
            "title"=>"Fondo","user"=>$user,"Modulos"=>$modulos,"Categorias"=>$Categorias,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Fondo_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = Fondo::find($request['id']);
           $elemento1->nombre =$request["nombre"];
           $elemento1->codigo =$request["codigo"];
          $elemento1->tipo =$request["tipo"];
          $elemento1->id_puc =$request["id_puc"];
          $elemento1->updatedDtm =date('Y-m-d H:i:s');
          $elemento1->updatedby =$user->id_usuario;
          $elemento1->id_banco =$request["id_banco"];
          $elemento1->inicial =$request["inicial"];
          $elemento1->numero =$request["numero"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
           
 			
          $elemento1->save();
         return redirect('/All_Fondo')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Fondo_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         Fondo::create([
           'nombre'=>$request["nombre"],
      		 'isDeleted'=>$request["isDeleted"],
      		  'createdBy'=>$user->id_usuario,
      		  'createdDtm'=>date('Y-m-d H:i:s'),
      		  'updatedDtm'=>date('Y-m-d H:i:s'),
      		   'updatedby'=>$user->id_usuario, 
             'isDeleted'=>0,
       			   'id_banco'=>$request["id_banco"],
               "tipo"=>1,
               "inicial"=>$request["inicial"],
               "codigo"=>$request["codigo"],
              "id_puc"=>$request["id_puc"],
              "numero"=>$request["numero"],
           				'id_establecimiento'=>$user->id_establecimiento
        ]);

        return redirect('/All_Fondo')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Fondo($id,$ruta)
    {
      $user = User::find(Auth::user()->id_usuario);
        $Bancos = Banco::all();
        $Pucs = Puc::where("tipo","=",1)
        ->where('id_establecimiento', '=', $user->id_establecimiento)->get();
          $modulos = Modulos::all();
             $Categorias=Categoria::all();
             $Medidas=Medida::all();
           
           $estilo="";
        $elemento="";
        if($ruta=="actualizar"){
          $ruta ="Fondo_update";
           $elemento =Fondo::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Fondo_create";
          $elemento1 = new stdClass();
          $elemento1->id_fondo = "";
          $elemento1->codigo = "";
          $elemento1->nombre ="";
          $elemento1->id_categoria ="";
          $elemento1->valor_costo ="";
          $elemento1->valor_venta ="";
          $elemento1->isDeleted ="";
          $elemento1->porcentaje_descuento ="";
          $elemento1->createdBy ="";
          $elemento1->createdDtm ="";
          $elemento1->updatedDtm ="";
          $elemento1->updatedby ="";
          $elemento1->porcentaje_iva ="";
          $elemento1->valor_iva ="";
          $elemento1->tipo ="";
          $elemento1->id_medida ="";
          $elemento1->inicial ="";
          $elemento1->id_establecimiento ="";
          $elemento1->id_puc ="";
          $elemento1->id_banco ="";
          $elemento1->numero ="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_Fondo";
           $estilo="none";
           $elemento =Fondo::find($id);
        }

      return view('bancos.Fondos.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,"Medidas"=>$Medidas,"Categorias"=>$Categorias,"Bancos"=>$Bancos,"Pucs"=>$Pucs,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Fondo($id)
    {
      //Fondo::destroy($id);
      $elemento =Fondo::find($id);
      $elemento->isDeleted=1;
      $elemento->save();
      return redirect('/All_Fondo')->with('status', "Elemento Eliminado Correctamente");
    }

}
