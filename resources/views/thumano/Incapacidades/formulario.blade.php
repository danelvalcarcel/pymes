
@extends('layouts.app')

@section('content')
@include("layouts.menu.thumano.admin")
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div style="font-size: 20px; display: inline-block; height: 100%; vertical-align: middle;">
                        Incapacidades
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
            <form id="form_sueldo" enctype="multipart/form-data" action="{{ route($ruta)}}" method="post">
                 {{ csrf_field() }}
                <div class="row">








                 <div class="col-md-12" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="idempleado"  class="col-md-4 form-control" style="border:none">Empleado</label>
                             </div>

                            <div class="col-md-6">
                                <select  id="idempleado" class="form-control" name="idempleado" >
                                    <option value="0">Selecciona una opcion</option>}
                                    option
                                    @foreach($Empleados as $data)
                                    <option value="{{$data->idempleado}}">{{$data->nombres}} {{$data->apellidos}}</option>
                                    @endforeach
                                </select>
                            </div>
                 </div>


                <div class="col-md-12" style="margin-top: 15px" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="documento">Documento</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="documento" type="text" name="documento" value="{{$elemento->documento}}" >
                    </div>
                </div>




                <div class="col-md-12" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="idtipoenfermedad"  class="col-md-4 form-control" style="border:none">Enfermedad</label>
                             </div>

                            <div class="col-md-6">
                                <select  id="idtipoenfermedad" class="form-control" name="idtipoenfermedad" >
                                    <option value="0">Selecciona una opcion</option>}
                                    option
                                    @foreach($Enfermedades as $data)
                                    <option value="{{$data->idtipoenfermedad}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                 </div>

                 <div class="col-md-12" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="idtipomotivo"  class="col-md-4 form-control" style="border:none">Motivo</label>
                             </div>

                            <div class="col-md-6">
                                <select  id="idtipomotivo" class="form-control" name="idtipomotivo" >
                                    <option value="0">Selecciona una opcion</option>}
                                    option
                                    @foreach($Motivos as $data)
                                    <option value="{{$data->idtipomotivo}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                 </div>
                 


                 <div class="col-md-12" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="fecha_desde">Fecha Desde</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control"  id="fecha_desde" type="date" name="fecha_desde"  value="{{$elemento->fecha_desde}}"  >
                    </div>
                </div>


                <div class="col-md-12" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="fecha_hasta">Fecha Hasta</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control"  id="fecha_hasta" type="date" name="fecha_hasta"  value="{{$elemento->fecha_hasta}}"  >
                    </div>
                </div>

                
                <div class="col-md-12" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="documento_incapacidad">Documento Incapacidad</label>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control"  id="documento_incapacidad" type="file" name="documento_incapacidad"  >
                    </div>
                </div>

                @if($elemento->documento_incapacidad != "")
                <div class="col-md-12" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="documento_incapacidad">Documento Incapacidad</label>
                    </div>
                    <div class="col-md-6">
                        <a target="_blank" href="{{url('/uploads/load_files_incapacidades/'.$elemento->documento_incapacidad)}}" class="btn btn-info">Ver Documento Adjunto</a>
                    </div>
                </div>
                @endif




              





 
                        
                
                    <div class="col-sm-12" style="padding-top: 30px">
                                         @if($ruta =="Incapacidade_update" )
                                         <div class="col-sm-6">
                                         <input type="hidden" name="id" value="{{$id}}">
                                        <input type="submit" id="save_elemento" value="Actualizar" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Incapacidade')}}" class="btn col-md-10 btn-warning col-md-offset-1 "  >
                                        Volver a Inicio
                                        </a>
                                        </div>
                                       @elseif($ruta =="Incapacidade_create" )
                                       <div class="col-sm-6">
                                        <input type="submit" id="save_elemento" value="Crear" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Incapacidade')}}" class="btn btn-warning col-md-10 col-md-offset-1 "  >
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
        
       
            $("#idtipoenfermedad").val("{{$elemento->idtipoenfermedad}}");
            $("#idempleado").val("{{$elemento->idempleado}}");
            $("#idtipomotivo").val("{{$elemento->idtipomotivo}}");
         









          $(document).on('change','input[type="file"]',function(){
                                // this.files[0].size recupera el tama単o del archivo
                                // alert(this.files[0].size);
                                
                                var fileName = this.files[0].name;
                                var fileSize = this.files[0].size;
                            
                                if(fileSize > 5000000){
                                    alert('El archivo no debe superar los 2MB');
                                    this.value = '';
                                    this.files[0].name = '';
                                }
                                  var val = $(this).val().toLowerCase();
                                    regex = new RegExp("(.*?)\.(docx|doc|pdf|jpg|jpeg|png|gif)$");

                                if (!(regex.test(val))) {
                                    $(this).val('');
                                    alert('Seleccione un Archivo de Formato Correcto');
                                    return
                                }
                                
    });

    });
</script>
@endsection
