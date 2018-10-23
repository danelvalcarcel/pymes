<?php

namespace App\Http\Controllers\Maestros;

use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Entidad;
use App\Arl;
use App\Inventario;
use App\Producto;
use App\Maestros\Categoria;
use App\Maestros\Medida;
use App\Maestros\Articulo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class MisArticuloController extends Controller
{
   


     protected $nombre_modulo = "Maestros";



      public function All_Articulo_Carga(Request $request)
    {
        //
       
        $Articulos="";
        $Categorias=Categoria::all();
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Articulos = Articulo::where("nombre","=",$request["busquedad"])
            ->where("isDeleted","<>",1)
            ->where("tipo","=",1)
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->where("isDeleted","<>",1)
            ->where("tipo","=",1)
            ->paginate(10);

        }else{
            $Articulos = Articulo::where("id_articulo",">",0)
            ->where("isDeleted","<>",1)
            ->where("tipo","=",1)
            ->paginate(10);
        }
       
         return view('maestro.MisArticulos.home_carga', array("Articulos"=>$Articulos,"title_menu"=>"Articulo",
            "title"=>"Articulo","user"=>$user,"Modulos"=>$modulos,"Categorias"=>$Categorias,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }




      public function All_Articulo(Request $request)
    {
        //
       
        $Articulos="";
        $Categorias=Categoria::all();
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Articulos = Articulo::where("nombre","=",$request["busquedad"])
            ->where("isDeleted","<>",1)
            ->where("tipo","=",2)
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')
            ->where("isDeleted","<>",1)
            ->where("tipo","=",2)
            ->paginate(10);

        }else{
            $Articulos = Articulo::where("id_articulo",">",0)
            ->where("isDeleted","<>",1)
            ->where("tipo","=",2)
            ->paginate(10);
        }
       
         return view('maestro.MisArticulos.home', array("Articulos"=>$Articulos,"title_menu"=>"Articulo",
            "title"=>"Articulo","user"=>$user,"Modulos"=>$modulos,"Categorias"=>$Categorias,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }



    public function Articulo_update(Request $request){

       
    		$user = User::find(Auth::user()->id_usuario);
          $elemento1 = Articulo::find($request['id']);
           $elemento1->nombre =$request["nombre"];
           $elemento1->codigo =$request["codigo"];
          $elemento1->id_categoria =$request["id_categoria"];
          $elemento1->valor_costo =$request["valor_costo"];
          $elemento1->valor_venta =$request["valor_venta"];
          $elemento1->porcentaje_descuento =$request["porcentaje_descuento"];
          $elemento1->updatedDtm =date('Y-m-d H:i:s');
          $elemento1->updatedby =$user->id_usuario;
          $elemento1->porcentaje_iva =$request["porcentaje_iva"];
          $elemento1->valor_iva =$request["valor_iva"];
          $elemento1->valor_descuento =$request["valor_descuento"];
          $elemento1->id_medida =$request["id_medida"];
          $elemento1->valor_pormayor =$request["valor_pormayor"];
          $elemento1->valor_total =$request["valor_total"];
          $elemento1->inicial =$request["inicial"];
          $elemento1->utilidad =$request["utilidad"];
           $elemento1->id_establecimiento=$user->id_establecimiento;
          $elemento1->save();
          $prod = Producto::where("article_pyme","=",$request['id'])->get();
           Producto::where("article_pyme","=",$request['id'])
          ->update((["nombre"=>$request["nombre"],"codigo"=>$request["codigo"],
          'categoria_id'=>$request["id_categoria"],
          "tamanio"=>1,'medida_id'=>$request["id_medida"],
                        "color"=>"Ninguno",
                        "foto"=>"ninguna",
                        "estado"=>"Activo",
                        "descripcion"=>"Producto de Empresa",
                        "precio_costo"=>$request["valor_costo"],
                        "precio_venta"=>$request["valor_venta"],
                        "estado_iva"=>"Activo",
                        "sucursale_id"=>1,
                        "empresa_id"=>1,
                        "id_establecimiento"=>$user->id_establecimiento,
                        "article_pyme"=>$request['id']]));

          Inventario::where("producto_id","=",$prod[0]["id"])
          ->update(["cantidad"=>$request["inicial"],'bodega_id'=>1,"estado"=>"Activo",
            "sucursale_id"=>1,"empresa_id"=>1,"id_establecimiento"=>$user->id_establecimiento]);



         return redirect('/All_MisArticulo')->with('status', "Elemento Actualizado Correctamente");

    }









     public function Articulo_create(Request $request){

     	$fecha =date('Y-m-d');
       	$user = User::find(Auth::user()->id_usuario);
         $articulo_creado =Articulo::create([
          'codigo'=>$request["codigo"],
           'nombre'=>$request["nombre"],
            'id_categoria'=>$request["id_categoria"],
             'valor_costo'=>$request["valor_costo"],
      		'valor_venta'=>$request["valor_venta"],
      		 'isDeleted'=>$request["isDeleted"],
      		  'createdBy'=>$user->id_usuario,
      		  'createdDtm'=>date('Y-m-d H:i:s'),
      		  'updatedDtm'=>date('Y-m-d H:i:s'),
      		   'updatedby'=>$user->id_usuario, 
             'isDeleted'=>0,
      		   'porcentaje_iva'=>$request["porcentaje_iva"],
       			'porcentaje_descuento'=>$request["porcentaje_descuento"],
       			 'valor_iva'=>$request["valor_iva"],
       			 'valor_descuento'=>$request["valor_descuento"],
       			  'id_medida'=>$request["id_medida"],
       			   'valor_pormayor'=>$request["valor_pormayor"],
               "tipo"=>2,
               "inicial"=>$request["inicial"],
               "utilidad"=>$request["utilidad"],
              "valor_total"=>$request["valor_total"],
           				'id_establecimiento'=>$user->id_establecimiento
        ]);

        $produc= Producto::create(["nombre"=>$request["nombre"],"codigo"=>$request["codigo"],
          'categoria_id'=>$request["id_categoria"],
          "tamanio"=>1,'medida_id'=>$request["id_medida"],
                        "color"=>"Ninguno",
                        "foto"=>"ninguna",
                        "estado"=>"Activo",
                        "descripcion"=>"Producto de Empresa",
                        "precio_costo"=>$request["valor_costo"],
                        "precio_venta"=>$request["valor_venta"],
                        "estado_iva"=>"Activo",
                        "sucursale_id"=>1,
                        "empresa_id"=>1,
                        "id_establecimiento"=>$user->id_establecimiento,
                        "article_pyme"=>$articulo_creado->id_articulo]);

          
           Inventario::create(["codigo"=> $request["codigo"],
            'producto_id'=>$produc->id,"cantidad"=>$request["inicial"],'bodega_id'=>1,"estado"=>"Activo",
            "sucursale_id"=>1,"empresa_id"=>1,"id_establecimiento"=>$user->id_establecimiento]);

        return redirect('/All_MisArticulo')->with('status', "Elemento Creado Correctamente");
    }




    public function formulario_Articulo($id,$ruta)
    {

          $modulos = Modulos::all();
             $Categorias=Categoria::all();
             $Medidas=Medida::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        if($ruta=="actualizar"){
          $ruta ="MisArticulo_update";
           $elemento =Articulo::find($id);
           $estilo="none";
        }else if($ruta=="crear"){

          $ruta ="MisArticulo_create";
          $elemento1 = new stdClass();
          $elemento1->id_articulo = "";
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
          $elemento1->valor_descuento ="";
          $elemento1->id_medida ="";
          $elemento1->valor_pormayor ="";
          $elemento1->id_establecimiento ="";
          $elemento1->valor_total ="";
          $elemento1->utilidad ="";
          $elemento1->tipo ="";
          $elemento1->inicial ="";
          
          $elemento = $elemento1;
                  	if($id != 0){
        		$elemento =Articulo::find($id);
        	}
           
        }else{
        	$ruta ="All_MisArticulo";
           $estilo="none";
           $elemento =Articulo::find($id);
        		if($id != 0){
        		$elemento =Articulo::find($id);
        		$ruta ="All_MisArticulo_Carga";
        	}
           
        }

      return view('maestro.MisArticulos.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,"Medidas"=>$Medidas,"Categorias"=>$Categorias,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Articulo($id)
    {
      //Articulo::destroy($id);
      $elemento =Articulo::find($id);
      $elemento->isDeleted=1;
      $elemento->save();
      $producto = Producto::where("article_pyme","=",$id)->get();
      Inventario::where("producto_id","=",$producto[0]["id"])->delete();
      Producto::where("article_pyme","=",$id)->delete();
      return redirect('/All_MisArticulo')->with('status', "Elemento Eliminado Correctamente");
    }
}
