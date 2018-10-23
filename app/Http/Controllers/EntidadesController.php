<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Modulos;
use App\Erp;
use App\Ciudad;
use App\CajaCompensacion;
use App\Entidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class EntidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */





    protected $nombre_modulo = "Maestros";




    public function All_Entidades(Request $request)
    {
        //
        $entidades="";
          $user = User::find(Auth::user()->id_usuario);
          $modulos = Modulos::all();
        if($request["busquedad"]){
            $entidades = Entidad::where("nombre","=",$request["busquedad"])
            ->orWhere('nombre', 'like', '%' . $request["busquedad"] . '%')->paginate(10);
        }else{
            $entidades = Entidad::where("id_establecimiento",">",0)->paginate(10);
        }
       
         return view('entidades.home', array("entidades"=>$entidades,"title_menu"=>"Entidad",
            "title"=>"Entidades", "user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }










    public function Entidades_update(Request $request){
        $this->validate($request, [
             'nombre'=> 'required|string|max:255',
             'direccion'=> 'required|string|max:255',
             'telefono'=> 'required|string|max:255',
             'nit'=> 'required|string|max:255',
             'residencia_dian'=> 'required|string|max:255',
             'celular'=> 'required|string|max:255',
             'regimen'=> 'required|string|max:255',
             'estado'=> 'required|numeric|max:255',
             'id_erp'=> 'required|numeric|max:255',
             'id_ciudad'=> 'required|numeric|max:255',
    ]);
       

          $elemento1 = Entidad::find($request['id']);
           $elemento1->documento = $request['doc_representante'];
          $elemento1->direccion =$request['direccion'];
          $elemento1->nombre =$request['nombre'];
          $elemento1->telefono =$request['telefono'];
          $elemento1->celular =$request['celular'];
          $elemento1->residencia_dian =$request['residencia_dian'];
          $elemento1->regimen =$request['regimen'];
          $elemento1->doc_representante =$request['doc_representante'];
          $elemento1->id_erp =$request['id_erp'];
          $elemento1->id_ciudad =$request['id_ciudad'];
          $elemento1->nit =$request['nit'];
          $elemento1->email =$request['email'];
          $elemento1->updatedBy =Auth::id();
          $elemento1->updatedDtm =date('Y-m-d H:i:s');
          $elemento1->estado =$request["estado"];
          $elemento1->nombre_representante=$request['nombre_representante'];
          $elemento1->cargo = $request['cargo'];
          $elemento1->idcajadecompensacion=$request["idcajadecompensacion"];

            if($request["logo"]){
            $storage_name =Storage::disk('public_incapacidades')->put('/',$request["logo"]);
            $elemento1->logo=$storage_name;
           }


          $elemento1->save();
         return redirect('/All_Entidades')->with('status', "Usuario Actualizado Correctamente");

    }









     public function Entidades_create(Request $request){

        $this->validate($request, [
             'nombre'=> 'required|string|max:255',
             'direccion'=> 'required|string|max:255',
             'telefono'=> 'required|string|max:255',
             'nit'=> 'required|string|max:255',
             'residencia_dian'=> 'required|string|max:255',
             'celular'=> 'required|string|max:255',
             'regimen'=> 'required|string|max:255',
             'estado'=> 'required|numeric|max:255',
             'id_erp'=> 'required|numeric|max:255',
             'id_ciudad'=> 'required|numeric|max:255',
    ]);
        $storage_name="";
        if($request["logo"]){
            $storage_name =Storage::disk('public_incapacidades')->put('/', $request["logo"]);
           }
       
         Entidad::create([
            'documento'=>$request['doc_representante'],
            'nombre'=>$request['nombre'],
            'direccion'=>$request['direccion'],
            'telefono'=>$request['telefono'],
            'estado'=>$request['estado'],
            'email'=>$request['email'],
            "doc_representante"=>$request['doc_representante'],
            "nombre_representante"=>$request['nombre_representante'],
            'isDeleted'=>0,
            'createdBy'=>  Auth::id(),
            'createdDtm'=> date('Y-m-d H:i:s'),
            'updatedBy'=> Auth::id(),
            'updatedDtm'=> date('Y-m-d H:i:s'),
            "celular"=>$request['celular'],
            "residencia_dian"=>$request['residencia_dian'],
            "regimen"=>$request['regimen'],
            "id_erp"=>$request['id_erp'],
            "id_ciudad"=>$request['id_ciudad'],
            "nit"=>$request['nit'],
            "cargo"=>$request['cargo'],
            "idcajadecompensacion"=>$request["idcajadecompensacion"],
            'logo'=>$storage_name

        ]);

        return redirect('/All_Entidades')->with('status', "Entidad Creado Correctamente");
    }




    public function formulario_Entidades($id,$ruta)
    {
       $user = User::find(Auth::user()->id_usuario);
      $modulos = Modulos::all();
         $cajas =CajaCompensacion::all();
           $estilo="";
        $Erps = Erp::All();
        $Ciudades = Ciudad::All();
        $elemento="";
        if($ruta=="actualizar"){
          $ruta ="Entidades_update";
           $elemento =Entidad::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="Entidades_create";
          $elemento1 = new stdClass();
          $elemento1->documento = "";
          $elemento1->direccion ="";
          $elemento1->nombre ="";
          $elemento1->telefono ="";
          $elemento1->celular ="";
          $elemento1->residencia_dian ="";
          $elemento1->regimen ="";
          $elemento1->doc_representante ="";
          $elemento1->id_erp ="";
          $elemento1->id_ciudad ="";
          $elemento1->estado ="";
          $elemento1->nit ="";
          $elemento1->email ="";
          $elemento1->idcajadecompensacion="";
          $elemento1->nombre_representante="";
          $elemento1->cargo="";
          $elemento1->logo="";
          $elemento = $elemento1;
        }else{
           $ruta ="All_Entidades";
           $estilo="none";
           $elemento =Entidad::find($id);
        }

      return view('entidades.formulario', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,
        "Erps"=> $Erps,"Ciudades"=>$Ciudades,"estilo"=>$estilo,"user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo,"Cajas"=>$cajas));
       
    }


 public function delete_Entidades($id)
    {
      Entidad::destroy($id);
      return redirect('/All_Entidades')->with('status', "Entidad Eliminada Correctamente");
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
