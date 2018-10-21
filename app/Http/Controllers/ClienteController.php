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
use Session;
use App\Modulos;


class ClienteController extends Controller
{

     protected $nombre_modulo = "Maestros";

    public function index()
    {
        //

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
}
