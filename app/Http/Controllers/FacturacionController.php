<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operacione;
use App\Caja_Operacione;
use App\Inventario_Operacione;
use App\Inventario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Cupo;
use App\Cuentas_pendiente;
use App\Modulos;
use App\User;
use Illuminate\Database\Eloquent\Relations\Pivot;
class FacturacionController extends Controller
{
    protected $nombre_modulo = "Maestros";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $user = User::find(Auth::user()->id_usuario);
          $modulos = Modulos::all();
        return view("facturacion.facturacion", 
          array("user"=>$user,"nombre_modulo"=>$this->nombre_modulo, "title"=>"Facturacion","user"=>$user,"Modulos"=>$modulos));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //bc



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consecutivo_new=0;
        //
        $errores="";
        $id_cliente =$request["id_cliente"];
        $tipo_operacion_id =$request["tipo_operacion_id"];
        $cantidades =$request["cantidades"];
        $inventarios =$request["inventarios"];
        $dineros =$request["dineros"];
        $descuentos =$request["descuentos"];
        $observacion =$request["observacion"];
        $cajas =$request["cajas"];
        $dinero_cajas =$request["dinero_cajas"];
        $tipo_pagos_caja = $request["tipo_pagos_caja"];
        $cod_inventarios =$request["cod_inventarios"];
        $total_operacion=$request["total"];





            //return;

        for($x =0 ; $x <count($cajas); $x=$x+1){

            if($tipo_pagos_caja[$x]==2){
             $cupo_disponible = Cupo::select("cupo_disponible")->where("cliente_id","=", $id_cliente)->get();
             $cupo_disponible_val =$cupo_disponible[0];
             if($cupo_disponible_val["cupo_disponible"]<$dinero_cajas[$x]){

                 $errores .= "Cupo Excedido, El Cliente Tiene un cupo disponible de ". $cupo_disponible_val["cupo_disponible"];
             }
            }
            }




        for($x =0 ; $x <count($inventarios); $x=$x+1){
            $cantidad_consultada =Inventario::select("cantidad")->find($inventarios[$x]);
            if($cantidades[$x]>$cantidad_consultada["cantidad"]){
            $errores .= "Cantidad no disponible en " . $cod_inventarios[$x]." ";
            }
        }
        if($errores!=""){
            echo json_encode(["mensaje"=>$errores,"estado"=>"Error"]);
            return;

    }
    $id_empresa = Auth::user()->id_establecimiento;
        $id_user = Auth::user()->id_usuario;
        $id_sucursale=Auth::user()->id_establecimiento;
        //echo json_encode($tipo_operacion_id)
      //  echo json_encode("hola empresa".$id_empresa." sucursale ".$id_sucursale." use".$id_user);
        try{
        DB::beginTransaction();
        $consecutivo = Operacione::select("consecutivo")->where([["id_establecimiento","=", $id_empresa],
            ["id_establecimiento","=",$id_sucursale],["tipo_operacione_id","=",$tipo_operacion_id]])->orderBy('consecutivo', 'desc')->first();

        $consecutivo_new = $consecutivo["consecutivo"] +1;

    $operacion= Operacione::create(array("tipo_operacione_id"=>$tipo_operacion_id,"cliente_id"=>$id_cliente,
        "user_id"=>$id_user,"consecutivo"=>$consecutivo_new,"total"=>$total_operacion,"observacion"=>$observacion,
        "sucursale_id"=>1,"empresa_id"=>1,"id_establecimiento"=>$id_empresa));


        for($x =0 ; $x <count($inventarios); $x=$x+1){
            $inventario_prod =Inventario::find($inventarios[$x]);
            $inventario_prod->cantidad=$inventario_prod->cantidad-$cantidades[$x];
            $inventario_prod->save();
        Inventario_Operacione::create(['operacione_id'=>$operacion->id,
            'inventario_id'=>$inventarios[$x],"cantidad_inv"=>$cantidades[$x],
            "dinero"=>$dineros[$x],"descuento"=>$descuentos[$x],
            "sucursale_id"=>1,
            "empresa_id"=>1,
            "id_establecimiento"=>$id_empresa]);



            }
            for($x =0 ; $x <count($cajas); $x=$x+1){
                Caja_Operacione::create(['operacione_id'=>$operacion->id,"caja_id"=>$cajas[$x],
                    "dinero"=>$dinero_cajas[$x],"tipo_pago_id"=>$tipo_pagos_caja[$x],
                    "sucursale_id"=>1,
                    "empresa_id"=>1,"id_establecimiento"=>$id_empresa]);
                if($tipo_pagos_caja[$x]==2){

                    $id_cupo = Cupo::select("id")->where("cliente_id","=", $id_cliente)->get();
                    $cupo=Cupo::find($id_cupo[0]["id"]);
                    $cupo_total =$cupo->cupo_disponible;
                    $cupo->cupo_disponible = ($cupo_total-$dinero_cajas[$x]);
                    $cupo->save();
                    Cuentas_pendiente::create(["operacione_id"=>$operacion->id,"deuda_inicial"=>$dinero_cajas[$x],
                        "deuda_cancelada"=>0,"deuda_pendiente"=>$dinero_cajas[$x],"cliente_id"=>$id_cliente,
                        "user_id"=>$id_user,"tipo_cuenta_pendiente_id"=>1,
                        "sucursale_id"=>1,
                        "empresa_id"=>1,
                        "id_establecimiento"=>$id_empresa]);
                }

            }
        echo json_encode(["mensaje"=>"Operacion Realizada Exitozamente","estado"=>"OK","con"=>""]);
            DB::commit();

        }
        catch(\Exception $e){

            DB::rollback();
            echo json_encode(["mensaje"=>$e->getMessage(),"estado"=>"Error","con"=>""]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       $user = User::find(Auth::user()->id_usuario);
          $modulos = Modulos::all();
        $operacion = Operacione::with("cliente")
        ->where("tipo_operacione_id","=",1)
        ->limit(50)->get();

    return view("facturacion.show_modificar",
      ["operaciones"=>$operacion, "user"=>$user,
      "nombre_modulo"=>$this->nombre_modulo, "title"=>"Facturacion","user"=>$user,"Modulos"=>$modulos,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        //$operacion = Operacione::with(["inventarios","inventarios.producto"])->where("id","=",$id)->get();

        $operaciones = Operacione::find($id);

      //
        //  echo json_encode($operaciones);
         $user = User::find(Auth::user()->id_usuario);
          $modulos = Modulos::all();
        return view("facturacion.form_modificar",["operacion"=>$operaciones,
       "user"=>$user,
      "nombre_modulo"=>$this->nombre_modulo, "title"=>"Facturacion","user"=>$user,"Modulos"=>$modulos]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {



          $consecutivo_new=0;
        //
        $errores="";
        $id_cliente =$request["id_cliente"];
        $tipo_operacion_id =$request["tipo_operacion_id"];
        $cantidades =$request["cantidades"];
        $inventarios =$request["inventarios"];
        $dineros =$request["dineros"];
        $descuentos =$request["descuentos"];
        $observacion =$request["observacion"];
        $cajas =$request["cajas"];
        $dinero_cajas =$request["dinero_cajas"];
        $tipo_pagos_caja = $request["tipo_pagos_caja"];
        $cod_inventarios =$request["cod_inventarios"];
        $total_operacion=$request["total"];





            //return;

        for($x =0 ; $x <count($cajas); $x=$x+1){

            if($tipo_pagos_caja[$x]==2){
             $cupo_disponible = Cupo::select("cupo_disponible")->where("cliente_id","=", $id_cliente)->get();
             $cupo_disponible_val =$cupo_disponible[0];
             if($cupo_disponible_val["cupo_disponible"]<$dinero_cajas[$x]){

                 $errores .= "Cupo Excedido, El Cliente Tiene un cupo disponible de ". $cupo_disponible_val["cupo_disponible"];
             }
            }
            }




        for($x =0 ; $x <count($inventarios); $x=$x+1){
            $cantidad_consultada =Inventario::select("cantidad")->find($inventarios[$x]);
            if($cantidades[$x]>$cantidad_consultada["cantidad"]){
            $errores .= "Cantidad no disponible en " . $cod_inventarios[$x]." ";
            }
        }
        if($errores!=""){
            echo json_encode(["mensaje"=>$errores,"estado"=>"Error"]);
            return;

    }
    $id_empresa = Auth::user()->id_establecimiento;
        $id_user = Auth::user()->id_usuario;
        $id_sucursale=Auth::user()->id_establecimiento;
        //echo json_encode($tipo_operacion_id)
      //  echo json_encode("hola empresa".$id_empresa." sucursale ".$id_sucursale." use".$id_user);
        try{
        DB::beginTransaction();

        //$consecutivo = Operacione::select("consecutivo")->where([["empresa_id","=", $id_empresa],
          //  ["sucursale_id","=",$id_sucursale],["tipo_operacione_id","=",$tipo_operacion_id]])->orderBy('consecutivo', 'desc')->first();
              $consecutivo= $id;
        $consecutivo_new = $consecutivo;
          Operacione::where([["empresa_id","=",1],["id_establecimiento","=", $id_empresa],
            ["sucursale_id","=",1],["consecutivo","=",$consecutivo_new],["tipo_operacione_id","=",$tipo_operacion_id]])->delete();
    $operacion= Operacione::create(array("tipo_operacione_id"=>$tipo_operacion_id,"cliente_id"=>$id_cliente,
        "user_id"=>$id_user,"consecutivo"=>$consecutivo_new,"total"=>$total_operacion,"observacion"=>$observacion,
        "sucursale_id"=>1,
            "empresa_id"=>1,
            "id_establecimiento"=>$id_empresa));

      Inventario_Operacione::where([["empresa_id","=", 1],["id_establecimiento","=", $id_empresa],
            ["sucursale_id","=",1],["operacione_id","=",$consecutivo_new]])->delete();
        for($x =0 ; $x <count($inventarios); $x=$x+1){
            $inventario_prod =Inventario::find($inventarios[$x]);
            $inventario_prod->cantidad=$inventario_prod->cantidad-$cantidades[$x];
            $inventario_prod->save();
        Inventario_Operacione::create(['operacione_id'=>$operacion->id,
            'inventario_id'=>$inventarios[$x],"cantidad_inv"=>$cantidades[$x],
            "dinero"=>$dineros[$x],"descuento"=>$descuentos[$x],
            "sucursale_id"=>1,
            "empresa_id"=>1,
            "id_establecimiento"=>$id_empresa]);



            }
            Caja_Operacione::where([["id_establecimiento","=", $id_empresa],
            ["id_establecimiento","=",$id_sucursale],["operacione_id","=",$consecutivo_new]])->delete();
              Cuentas_pendiente::where([["id_establecimiento","=", $id_empresa],
            ["id_establecimiento","=",$id_sucursale],["id_establecimiento","=",$consecutivo_new]])->delete();
            for($x =0 ; $x <count($cajas); $x=$x+1){

                Caja_Operacione::create(['operacione_id'=>$operacion->id,"caja_id"=>$cajas[$x],
                    "dinero"=>$dinero_cajas[$x],"tipo_pago_id"=>$tipo_pagos_caja[$x],
                     "sucursale_id"=>1,
                    "empresa_id"=>1,"id_establecimiento"=>$id_empresa]);
              

                if($tipo_pagos_caja[$x]==2){

                    $id_cupo = Cupo::select("id")->where("cliente_id","=", $id_cliente)->get();
                    $cupo=Cupo::find($id_cupo[0]["id"]);
                    $cupo_total =$cupo->cupo_disponible;
                    $cupo->cupo_disponible = ($cupo_total-$dinero_cajas[$x]);
                    $cupo->save();
                    Cuentas_pendiente::create(["operacione_id"=>$operacion->id,"deuda_inicial"=>$dinero_cajas[$x],
                        "deuda_cancelada"=>0,"deuda_pendiente"=>$dinero_cajas[$x],"cliente_id"=>$id_cliente,
                        "user_id"=>$id_user,"tipo_cuenta_pendiente_id"=>1,
                        "sucursale_id"=>1,
                        "empresa_id"=>1,
                        "id_establecimiento"=>$id_empresa]);
                }

            }
        echo json_encode(["mensaje"=>"Operacion Realizada Exitozamente","estado"=>"OK","con"=>""]);
            DB::commit();

        }
        catch(\Exception $e){

            DB::rollback();
            echo json_encode(["mensaje"=>$e->getMessage(),"estado"=>"Error","con"=>""]);
        }




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
