<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUsermy;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterCliente;
use Redirect;
use App\Tipo_documento;
use Session;
use App\Modulos;
use \stdClass;


class ClienteController extends Controller
{

     protected $nombre_modulo = "Maestros";


    public function index()
    {

        $user = User::find(Auth::user()->id_usuario);
          $modulos = Modulos::all();
        return view("cliente.register",
         array("user"=>$user,"nombre_modulo"=>$this->nombre_modulo, "title"=>"Facturacion","user"=>$user,"Modulos"=>$modulos));

    }
    public function index2()
    {
        //
        $user = User::find(Auth::user()->id_usuario);
          $modulos = Modulos::all();
        return view("cliente.register_cop",
         array("user"=>$user,"nombre_modulo"=>$this->nombre_modulo, "title"=>"Facturacion","user"=>$user,"Modulos"=>$modulos));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        try{
            DB::beginTransaction();
            $cliente = Cliente::create(['firts_name' => $request["firts_name"],
                'last_name' => $request["last_name"], 'email' => $request["email"],
                'cedula' => $request["cedula"], "pais" => $request["pais"],
                "departamento" => $request["departamento"], "municipio" => $request["municipio"],
                "direccion" => $request["direccion"], "tel_fijo" => $request["tel_fijo"],
                "celular_1" => $request["celular_1"], "celular_2" => $request["celular_2"],
                "observacion" => $request["observacion"], "tipo_cliente_id" => $request["tipo_cliente_id"],
                "sucursale_id" =>1,
                 "empresa_id" => 1,
                   "mensualidad"=> $request["mensualidad"],
                 "id_establecimiento"=>Auth::user()->id_establecimiento
            ]);

            DB::commit();
            Session::flash('message', 'Creado Correctamente');
            if(isset($request["facturacion"])){
                return redirect("Cliente2");
            }
            return redirect("Clientes");

        }
        catch(\Exception $e){

            DB::rollback();

            Session::flash('message-error', 'Error al intentar crear user'.$e->getMessage());
            if(isset($request["facturacion"])){
                return redirect("Cliente2");
            }
            return redirect("Clientes");
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

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
    }
    public function show_fact_cli($cedula, $empresa)
    {
        //

        $clientes =Cliente::where("cedula","=",$cedula)
            ->where("id_establecimiento","=",$empresa)->get();
        echo json_encode($clientes);
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
        //
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













    public function All_Cliente(Request $request)
    {
        //
                $user = User::find(Auth::user()->id_usuario);
          $modulos = Modulos::all();
          $Clientes =Cliente::All();
       

        $Clientes="";
        $modulos = Modulos::all();
         $user = User::find(Auth::user()->id_usuario);
        if($request["busquedad"]){
            $Clientes = Cliente::where("firts_name","=",$request["busquedad"])
            ->orWhere('firts_name', 'like', '%' . $request["busquedad"] . '%')
            ->paginate(10);
        }else{
            $Clientes = Cliente::where("id",">",0)
            ->where('id_establecimiento', '=', $user->id_establecimiento)
            ->paginate(10);
        }
       
         return view("cliente.home",
         array("user"=>$user,"nombre_modulo"=>$this->nombre_modulo,
          "title"=>"Clientes","user"=>$user,"Modulos"=>$modulos,
            "Clientes"=>$Clientes));
    }



    public function Cliente_update(Request $request){

       
         try{
            DB::beginTransaction();
            $cliente = Cliente::find($request['id']);
            $cliente->firts_name =$request["firts_name"];
            $cliente->last_name =$request["last_name"];
            $cliente->email =$request["email"];
            $cliente->cedula = $request["cedula"];
            $cliente->pais =$request["pais"];
            $cliente->departamento =$request["departamento"];
            $cliente->municipio =$request["municipio"];
            $cliente->direccion = $request["direccion"];
            $cliente->tel_fijo =$request["tel_fijo"];
            $cliente->celular_1 =$request["celular_1"];
            $cliente->celular_2 =$request["celular_2"];
             $cliente->cupo =$request["cupo"];
              $cliente->plazo =$request["plazo"];
            $cliente->observacion =$request["observacion"];
            $cliente->tipo_cliente_id =$request["tipo_cliente_id"];
            $cliente->mensualidad =$request["mensualidad"];
            $cliente->tipodocumento=$request["tipodocumento"];
            $cliente->id_establecimiento =Auth::user()->id_establecimiento;
                $cliente->save();

            DB::commit();
            Session::flash('message', 'Creado Correctamente');
            if(isset($request["facturacion"])){
                return redirect("Cliente2");
            }
            return redirect("All_Cliente");

        }
        catch(\Exception $e){

            DB::rollback();

            Session::flash('message-error', 'Error al intentar crear user'.$e->getMessage());
            if(isset($request["facturacion"])){
                return redirect("Cliente2");
            }
            return redirect("All_Cliente");
        }




    }









     public function Cliente_create(Request $request){

       
         try{
            DB::beginTransaction();
            $cliente = Cliente::create(['firts_name' => $request["firts_name"],
                'last_name' => $request["last_name"], 'email' => $request["email"],
                'cedula' => $request["cedula"], "pais" => $request["pais"],
                "departamento" => $request["departamento"], "municipio" => $request["municipio"],
                "direccion" => $request["direccion"], "tel_fijo" => $request["tel_fijo"],
                "celular_1" => $request["celular_1"], "celular_2" => $request["celular_2"],
                "observacion" => $request["observacion"], "tipo_cliente_id" => $request["tipo_cliente_id"],
                "sucursale_id" =>1,
                 "empresa_id" => 1,
                 "cupo" => $request["cupo"],
                 "plazo" => $request["plazo"],
                 "mensualidad"=> $request["mensualidad"],
                 "tipodocumento"=> $request["tipodocumento"],
                 "id_establecimiento"=>Auth::user()->id_establecimiento
            ]);

            DB::commit();
            Session::flash('message', 'Creado Correctamente');
            if(isset($request["facturacion"])){
                return redirect("Cliente2");
            }
            return redirect("All_Cliente");

        }
        catch(\Exception $e){

            DB::rollback();

            Session::flash('message-error', 'Error al intentar crear user'.$e->getMessage());
            if(isset($request["facturacion"])){
                return redirect("Cliente2");
            }
            return redirect("All_Cliente");
        }


    }




    public function formulario_Cliente($id,$ruta)
    {
        //
            
          $modulos = Modulos::all();
           $user = User::find(Auth::user()->id_usuario);
           $estilo="";
        $elemento="";
        $all_tipo_documento=Tipo_documento::all();
  
        if($ruta=="actualizar"){
          $ruta ="Cliente_update";
           $elemento =Cliente::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Cliente_create";
          $elemento1 = new stdClass();
            $elemento1->firts_name ="";
            $elemento1->last_name ="";
            $elemento1->email ="";
            $elemento1->cedula = "";
            $elemento1->pais ="";
            $elemento1->departamento ="";
            $elemento1->municipio ="";
            $elemento1->direccion = "";
            $elemento1->tel_fijo ="";
            $elemento1->celular_1 ="";
            $elemento1->celular_2 ="";
            $elemento1->observacion ="";
            $elemento1->tipo_cliente_id ="";
            $elemento1->mensualidad ="";
            $elemento1->id_establecimiento ="";
            $elemento1->cupo ="";
            $elemento1->plazo ="";
            $elemento1->tipodocumento="";
            $elemento = $elemento1;

        }else{
           $ruta ="All_Cliente";
           $estilo="none";
           $elemento =Cliente::find($id);
        }

      return view('cliente.register', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,"user"=>$user,"Modulos"=>$modulos,
        "estilo"=>$estilo,"all_tipo_documento"=>$all_tipo_documento,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }


 public function delete_Cliente($id)
    {
      Cliente::destroy($id);
      return redirect('/All_Cliente')->with('status', "Elemento Eliminado Correctamente");
    }


}
