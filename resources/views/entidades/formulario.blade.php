
@extends('layouts.app')

@section('content')
@include('layouts.menu.maestros.admin')
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">

            <div class="panel-heading">
                    <div style="font-size: 20px; display: inline-block; height: 100%; vertical-align: middle;">
                        Entidades
                    </div>
                </div>
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

                   <div class="col-md-12" style="text-align: center;" >
                   @if($elemento->logo != "")
                  <img src="{{url('/uploads/load_files_incapacidades/'.$elemento->logo)}}" alt="Avatar" class="avatar">
                @endif
                   
                </div>
            <form action="{{ route($ruta)}}" method="post" enctype="multipart/form-data">
                 {{ csrf_field() }}
                <div class="row">


                <div class="col-md-12" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="nombre">Nombre</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="nombre" type="text" name="nombre" value="{{$elemento->nombre}}"  placeholder="Nombres del Establecimiento">
                    </div>
                </div>


                <div class="col-md-12" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="direccion">Direccion</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="direccion" type="text" name="direccion" value="{{$elemento->direccion}}"  placeholder="Direccion del Establecimiento">
                    </div>
                </div>

                <div class="col-md-12" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="residencia_dian">Direccion Residencia Dian</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="residencia_dian" type="text" name="residencia_dian" value="{{$elemento->residencia_dian}}"  placeholder="Direccion del Establecimiento">
                    </div>
                </div>

                <div class="col-md-12" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="nit">Nit</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="nit" type="text" name="nit" value="{{$elemento->nit}}"  placeholder="89000000-1">
                    </div>
                </div>

                <div class="col-md-12" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="nombre_representante">Nombre Representante</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="nombre_representante" type="text" name="nombre_representante" value="{{$elemento->nombre_representante}}"  placeholder="Nombre Representante">
                    </div>
                </div>

                <div class="col-md-12" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="doc_representante">Documento Representante</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="doc_representante" type="text" name="doc_representante" value="{{$elemento->doc_representante}}"  placeholder="Documento Representante">
                    </div>
                </div>

                <div class="col-md-12" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="cargo">Cargo</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="cargo" type="text" name="cargo" value="{{$elemento->cargo}}"  placeholder="Cargo Representante">
                    </div>
                </div>


                <div class="col-md-12" style="margin-top: 10px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="celular">Celular</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="celular" type="number" name="celular" value="{{$elemento->celular}}"  placeholder=" 3132222111">
                    </div>
                </div>


                <div class="col-md-12" style="margin-top: 10px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="telefono">Telefono</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="telefono" type="number" name="telefono" value="{{$elemento->telefono}}"  placeholder=" 3132222111">
                    </div>
                </div>



                <div class="col-md-12" style="margin-top: 10px">
                             <div class="col-md-4">
                            <label for="regimen" class="col-md-4 form-control" style="border:none">Regimen</label>
                        </div>

                            <div class="col-md-6">
                                <select required id="regimen" class="form-control" name="regimen" >
                                   <option value="No Responsable de Iva">No Responsable de Iva</option>
                                   <option value="Regimen Comun">Regimen Comun</option>
                                   <option value="Regimen Simplificado">Regimen Simplificado</option>
                                   
                                </select>
                                
                            </div>
                        </div> 


                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="col-md-4">
                            <label for="id_erp"  class="col-md-4 form-control" style="border:none">Arl</label>
                             </div>

                            <div class="col-md-6">
                                <select required  id="id_erp" class="form-control" name="id_erp" >
                                    @foreach($Erps as $data)
                                    <option value="{{$data->id_erp}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-md-12" style="margin-top: 10px">
                            <div class="col-md-4">
                            <label for="idcajadecompensacion"  class="col-md-4 form-control" style="border:none">Caja de Compensacion</label>
                             </div>

                            <div class="col-md-6">
                                <select required  id="idcajadecompensacion" class="form-control" name="idcajadecompensacion" >
                                    @foreach($Cajas as $data)
                                    <option value="{{$data->idcajadecompensacion}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                          <div class="col-md-12" style="margin-top: 10px">
                             <div class="col-md-4">
                            <label for="id_ciudad" class="col-md-4 form-control" style="border:none">Ciudad</label>
                        </div>

                            <div class="col-md-6">
                                <select required id="id_ciudad" class="form-control" name="id_ciudad" >
                                    @foreach($Ciudades as $data)
                                    <option   value="{{$data->idciudad}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div> 


                


                           
                    <div class="col-md-12" style="margin-top: 10px">
                             <div class="col-md-4">
                            <label for="estado" class="col-md-4 form-control" style="border:none">Estado</label>
                        </div>

                            <div class="col-md-6">
                                <select required id="estado" class="form-control" name="estado" >
                                   <option value="1">Activo</option>
                                   <option value="2">Inactivo</option>
                                   
                                </select>
                                
                            </div>
                        </div> 

                    <div class="row" style="margin-top: 20px">
                        <div class="col-sm-6">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="logo">Logo</label>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control"  id="logo" type="file" name="logo"  >
                    </div>
                </div>
                </div>






 
                        
                
                    <div class="col-sm-12" style="padding-top: 30px">
                                         @if($ruta =="Entidades_update" )
                                         <div class="col-sm-6">
                                         <input type="hidden" name="id" value="{{$id}}">
                                        <input type="submit" id="save_elemento" value="Actualizar" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Entidades')}}" class="btn col-md-10 btn-warning col-md-offset-1 "  >
                                        Volver a Inicio
                                        </a>
                                        </div>
                                       @elseif($ruta =="Entidades_create" )
                                       <div class="col-sm-6">
                                        <input type="submit" id="save_elmento" value="Crear" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Entidades')}}" class="btn btn-warning col-md-10 col-md-offset-1 "  >
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
<style>
.avatar {
    vertical-align: middle;
    width: 150px;
    height: 150px;
    border-radius: 50%;
}
</style>
@endsection

@section('script')
<script >
    $(document).ready(function($) {
        $("#id_erp").val("{{$elemento->id_erp}}");
        $("#id_ciudad").val("{{$elemento->id_ciudad}}")
         $("#estado").val("{{$elemento->estado}}")
         
        $("#idcajadecompensacion").val("{{$elemento->idcajadecompensacion}}")


         $("#subproceso_id").on("change", function(){

            $("#proceso_id").val($("#subproceso_id option:selected").attr("data-proceso"));
        
        });

         






    });
</script>
@endsection
