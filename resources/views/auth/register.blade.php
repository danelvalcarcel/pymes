
@extends('layouts.app')

@section('content')
@include('layouts.menu.admin')
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="panel-body">
            <form action="{{ route($ruta)}}" method="post">
                 {{ csrf_field() }}
                <div class="row">

                 <div class="col-md-12" style="margin-top: 10px">
                            <div class="col-md-4">
                            <label for="roleid"  class="col-md-4 form-control" style="border:none">Rol de Usuario</label>
                             </div>

                            <div class="col-md-6">
                                <select  id="roleid" class="form-control" name="roleid" >
                                    @foreach($Roles as $data)
                                    <option value="{{$data->roleId}}">{{$data->role}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                          <div class="col-md-12" style="margin-top: 10px">
                             <div class="col-md-4">
                            <label for="id_establecimiento" class="col-md-4 form-control" style="border:none">Establecimiento</label>
                        </div>

                            <div class="col-md-6">
                                <select id="id_establecimiento" class="form-control" name="id_establecimiento" >
                                    @foreach($Entidades as $data)
                                    <option  value="{{$data->id_establecimiento}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div> 


                          <div class="col-md-12" style="margin-top: 10px">
                             <div class="col-md-4">
                            <label for="idsede" class="col-md-4 form-control" style="border:none">Sede</label>
                        </div>

                            <div class="col-md-6">
                                <select id="idsede" class="form-control" name="idsede" >
                                    @foreach($Sedes as $data)
                                    <option class="{{$data->id_establecimiento}}" value="{{$data->idsede}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div> 


                <div class="col-md-12" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="nombres">Nombres</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="nombres" type="text" name="nombres" value="{{$elemento->nombres}}"  placeholder="Nombres del usuario">
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 10px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="correo">Email</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="correo" type="email" name="correo" value="{{$elemento->correo}}"  placeholder="Correo Electronico">
                       
                    </div>
                </div>


                        @if($elemento->clave != "")
                <div class="col-md-12" style="margin-top: 10px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="clave">Cambiar Clave</label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" id="cambiar"
                   name="cambiar" value="Si" />
                       <label>Si</label>
                    </div>
                    
                    
                    <div class="col-md-3">
                        <input checked type="radio" id="cambiar"
                   name="cambiar" value="No" />
                       <label>No</label>
                    </div>
                </div>
                @endif
                
                                <div class="col-md-12" style="margin-top: 10px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="clave">Clave</label>
                    </div>
                    <div class="col-md-6">
                        <input id="clave" type="password" class="form-control" name="clave"  placeholder="Clave" 
                         @if($elemento->clave == "")
                        required
                        @endif >
                    </div>
                </div>
                

                <div class="col-md-12" style="margin-top: 10px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="clave">Confirmar Clave</label>
                    </div>
                    <div class="col-md-6">
                        <input id="clave-confirm" type="password" class="form-control" name="clave_confirmation"  placeholder="Clave"
                        @if($elemento->clave == "")
                        required
                        @endif 
                        >
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 10px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="mobile">Celular</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="mobile" type="number" name="mobile" value="{{$elemento->mobile}}"  placeholder=" 3132222111">
                    </div>
                </div>

                
                   <div class="col-md-12" style="margin-top: 10px">
                             <div class="col-md-4">
                            <label for="proceso_id" class="col-md-4 form-control" style="border:none">Responsable</label>
                        </div>

                            <div class="col-md-6">
                                <div class="well" style="max-height: 300px;overflow: auto;">
                                    <ul class="list-group checked-list-box">
                                        @php
                                        $mismodulos = explode("-", $elemento->modulos_id);
                                       
                                        @endphp
                                     @foreach($Modulos as $data)
                                      @if($ruta !="User_create" )
                                       @if(in_array($data->id_esquema,$mismodulos))
                                    <li class="list-group-item col-sm-6"><input checked type="checkbox" name="esquema{{$loop->iteration}}" value="{{$data->id_esquema}}">{{$data->esquema}}</li>                                      
                                       @else
                                    <li class="list-group-item col-sm-6"><input type="checkbox" name="esquema{{$loop->iteration}}" value="{{$data->id_esquema}}">{{$data->esquema}}</li>                                      
                                       @endif
                                    
                                      @else
                                    <li class="list-group-item col-sm-6"><input type="checkbox" name="esquema{{$loop->iteration}}" value="{{$data->id_esquema}}">{{$data->esquema}}</li>
                                      @endif
                                    
                                    @endforeach
                                      
                                    </ul>
                                </div>
                                
                            </div>
                    </div>


                           
                    <div class="col-md-12" style="margin-top: 10px">
                             <div class="col-md-4">
                            <label for="estado" class="col-md-4 form-control" style="border:none">Estado</label>
                        </div>

                            <div class="col-md-6">
                                <select id="estado" class="form-control" name="estado" >
                                   <option value="1">Activo</option>
                                   <option value="2">Inactivo</option>
                                   
                                </select>
                                
                            </div>
                        </div> 





 
                        
                
                    <div class="col-sm-12" style="padding-top: 30px">
                                         @if($ruta =="User_update" )
                                         <div class="col-sm-6">
                                         <input type="hidden" name="id" value="{{$id}}">
                                        <input type="submit" id="save_elemento" value="Actualizar" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_users')}}" class="btn col-md-10 btn-warning col-md-offset-1 "  >
                                        Volver a Inicio
                                        </a>
                                        </div>
                                       @elseif($ruta =="User_create" )
                                       <div class="col-sm-6">
                                        <input type="submit" id="save_elmento" value="Crear" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_users')}}" class="btn btn-warning col-md-10 col-md-offset-1 "  >
                                       Volver a Inicio
                                        </a>
                                        </div>
                                       @else

                                    <a href="{{ route($ruta)}}" class="btn col-md-6 col-md-offset-3" style="background: #a50029; color: #fff" >
                                        Volver a Inicio
                                    </a>
                                        @endif
                                    
                                </div>
               
                        </div>  

                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script >
    $(document).ready(function($) {
        $("#roleid").val("{{$elemento->roleid}}");
        $("#id_establecimiento").val("{{$elemento->id_establecimiento}}")
         $("#estado").val("{{$elemento->estado}}")
         
         
        $("#id_establecimiento").on("change", function(){

          var clase = $(this).val();
            
          $("#idsede > option").hide();
          $("#idsede").val("");
          $("#idsede option."+clase).show();
          
          if($("#idsede > option."+clase).length >0){
            $("#idsede").val("{{$elemento->idsede}}")
          }
          
        });
        $("#id_establecimiento").change();
        


         $("#subproceso_id").on("change", function(){

            $("#proceso_id").val($("#subproceso_id option:selected").attr("data-proceso"));
        
        });

         






    });
</script>
@endsection
