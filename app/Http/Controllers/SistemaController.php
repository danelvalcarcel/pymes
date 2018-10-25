<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use \stdClass;
use App\Rol;
use App\Maestros\Sede;
use App\Modulos;
use App\Entidad;
use App\Centros_trabajo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class SistemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $nombre_modulo = "Maestros";

      public function login_auth(Request $request)
    {
       
        $user = User::where("correo","=",$request["email"])
        ->where("clave","=",sha1($request["password"]))
        ->get();
        if( count($user)>0){
          Auth::loginUsingId($user[0]["id_usuario"]);
        }else{
             return redirect('/login')->with('status', "Las credenciales no son correctas"); 
        }
     
        
        if (Auth::check())
        {
           $user = User::find(Auth::user()->id_usuario);
           $user->fecha_registro = date("Y-m-d");
           $user->save();
       return redirect('/home')->with('status', "Bienvenido al Sistema");
        }
        else
        {
          return redirect('/login')->with('status', "Las credenciales no son correctas");
        }   
        
    }


    public function User_create(Request $request){
        $this->validate($request, [
        'correo'=> 'required|string|max:255',
             'clave'=>'required|string|min:6|confirmed',
             'nombres'=> 'required|string|max:255',
             'mobile'=> 'required|string|max:255',
             'roleid'=> 'required|numeric|max:255',
             'id_establecimiento'=> 'required|numeric|max:255',
             'estado'=> 'required|numeric|max:255'
    ]);
        $esquemas="";
            for($i=1; $i<=15; $i++) {
                    if ($request['esquema'.$i])
                    {
                    $esquemas =  $esquemas."-".$request['esquema'.$i];
                    }
                 }
         User::create([
            'correo'=>  $request['correo'],
            'clave'=>   sha1($request['clave']),
            'nombres'=>  $request['nombres'],
            'mobile'=>  $request['mobile'],
            'roleid'=>  $request['roleid'],
            'createdBy'=>  Auth::id(),
            'createdDtm'=> date('Y-m-d H:i:s'),
            'updatedBy'=> Auth::id(),
            'updatedDtm'=> date('Y-m-d H:i:s'),
            'id_establecimiento'=> $request['id_establecimiento'],
            'role'=> 1,
            'estado'=> $request["estado"],
            'idcentro'=> $request["idcentro"],
            "modulos_id"=>$esquemas
        ]);
         return redirect('/All_users')->with('status', "Usuario Creado Correctamente");

    }





    public function User_update(Request $request){
        $this->validate($request, [
        'correo'=> 'required|string|max:255',
             'nombres'=> 'required|string|max:255',
             'mobile'=> 'required|string|max:255',
             'roleid'=> 'required|numeric|max:255',
             'id_establecimiento'=> 'required|numeric|max:255',
             'estado'=> 'required|numeric|max:255'
    ]);
        $esquemas="";
            for($i=1; $i<=15; $i++) {
                    if ($request['esquema'.$i])
                    {
                    $esquemas =  $esquemas."-".$request['esquema'.$i];
                    }
                 }

          $elemento1 = User::find($request['id']);
          $elemento1->correo =  $request['correo'];
                  if($request['cambiar']=="Si")
                  {
                 $elemento1->clave =sha1($request['clave']);
        }
         
          $elemento1->nombres =$request['nombres'];
          $elemento1->mobile =$request['mobile'];
          $elemento1->roleid =$request['roleid'];
          $elemento1->id_establecimiento =$request['id_establecimiento'];
          $elemento1->updatedBy =Auth::id();
          $elemento1->updatedDtm =date('Y-m-d H:i:s');
          $elemento1->estado =$request["estado"];
          $elemento1->idcentro =$request["idcentro"];
          
          $elemento1->modulos_id=$esquemas;
          $elemento1->save();
         return redirect('/All_users')->with('status', "Usuario Actualizado Correctamente");

    }






    public function All_users(Request $request){
            $datas="";
            $modulos = Modulos::all();
            
             $user = User::find(Auth::user()->id_usuario);

        if($request["busquedad"]){
            $datas = User::where("nombres","=",$request["busquedad"])
            ->orWhere('nombres', 'like', '%' . $request["busquedad"] . '%')
            ->paginate(10);
        }else{
            $datas = User::where("id_usuario",">",0)
            ->paginate(10);
        }
         return view('usuarios.home', array("datas"=>$datas,"title_menu"=>"Usuario",
            "title"=>"Usuarios","user"=>$user,"Modulos"=>$modulos,
            "nombre_modulo"=>$this->nombre_modulo)); 
    }

    public function register($id,$ruta)
    {
        //

           $estilo="";
            $user = User::find(Auth::user()->id_usuario);
        $modulos = Modulos::all();
        $Roles = Rol::All();
        $Modulos = Modulos::All();
        $Entidades = Entidad::All();
        $Sedes =Sede::all();
        $Centros =Centros_trabajo::all();
        $elemento="";
        if($ruta=="actualizar"){
          $ruta ="User_update";
           $elemento =User::find($id);
           $estilo="none";
        }else if($ruta=="crear"){
          $ruta ="User_create";
          $elemento1 = new stdClass();
          $elemento1->correo = "";
          $elemento1->clave ="";
          $elemento1->nombres ="";
          $elemento1->mobile ="";
          $elemento1->roleid ="";
          $elemento1->id_establecimiento ="";
          $elemento1->frecuencia ="";
          $elemento1->origen ="";
          $elemento1->meta_cucuta ="";
          $elemento1->meta_bucaramanga ="";
          $elemento1->estado ="";
          $elemento1->modulos_id="";
          $elemento1->idcentro="";
          
          $elemento = $elemento1;
        }else{
           $ruta ="All_users";
           $estilo="none";
           $elemento =User::find($id);
        }

      return view('auth.register', array('elemento' => $elemento,"id"=>$id,"ruta"=>$ruta,
        "Roles"=>$Roles,"Modulos"=>$Modulos,"Entidades"=>$Entidades,"Centros"=>$Centros,
        "user"=>$user, "estilo"=>$estilo,"Modulos"=>$modulos,"Sedes"=>$Sedes,
            "nombre_modulo"=>$this->nombre_modulo));
       
    }



    public function delete_users($id)
    {
      User::destroy($id);
      return redirect('/All_users')->with('status', "Usuario Eliminada Correctamente");
    }

    public function Cambiar_Fecha(Request $request)
    {
           $user = User::find(Auth::user()->id_usuario);
           $user->fecha_registro = $request["fecha"];
           $user->save();
           return ["message"=>"OK"];
      
    }

    public function index()
    {
        //

    
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
