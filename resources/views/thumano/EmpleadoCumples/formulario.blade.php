
@extends('layouts.app')

@section('content')
@include("layouts.menu.thumano.admin")
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div style="font-size: 20px; display: inline-block; height: 100%; vertical-align: middle;">
                        CambioAfps
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

                 <div class="col-md-12" style=" margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="documento">Documento</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="documento" type="number" name="documento" value="{{$elemento->documento}}" >
                    </div>
                </div>




                 <div class="col-md-12" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="fecha_desde">Fecha </label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control"  id="fecha_desde" type="date" name="fecha_desde"  value="{{$elemento->fecha_desde}}"  >
                    </div>
                </div>


                <div class="col-md-12" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="idafp"  class="col-md-4 form-control" style="border:none">Nueva Afp</label>
                             </div>

                            <div class="col-md-6">
                                <select  id="idafp" class="form-control" name="idafp" >
                                   
                                    option
                                    @foreach($Epps as $data)
                                    <option value="{{$data->idepp}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                 </div>


               

                <div class="col-md-12" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="observacion">Observacion</label>
                    </div>
                    <div class="col-md-6">
                        <textarea rows="5"  required class="form-control" id="observacion" name="observacion" >{{$elemento->observacion}}</textarea>
                    </div>
                </div>



                <div class="col-md-12" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="documento_cargar">Documento a Cargar</label>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control"  id="documento_cargar" type="file" name="documento_cargar"  >
                    </div>
                </div>

                @if($elemento->documento_cargar != "")
                <div class="col-md-12" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="documento_cargar">Documento de Cambio</label>
                    </div>
                    <div class="col-md-6">
                        <a target="_blank" href="{{url('/uploads/load_files_incapacidades/'.$elemento->documento_cargar)}}" class="btn btn-info">Ver Documento Adjunto</a>
                    </div>
                </div>
                @endif


                
                    <div class="col-sm-12" style="padding-top: 30px">
                                         @if($ruta =="CambioAfp_update" )
                                         <div class="col-sm-6">
                                         <input type="hidden" name="id" value="{{$id}}">
                                        <input type="submit" id="save_elemento" value="Actualizar" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_CambioAfp')}}" class="btn col-md-10 btn-warning col-md-offset-1 "  >
                                        Volver a Inicio
                                        </a>
                                        </div>
                                       @elseif($ruta =="CambioAfp_create" )
                                       <div class="col-sm-6">
                                        <input type="submit" id="save_elemento" value="Crear" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_CambioAfp')}}" class="btn btn-warning col-md-10 col-md-offset-1 "  >
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
        
       
            $("#idtipoCambioAfp").val("{{$elemento->idtipoCambioAfp}}");
            $("#idempleado").val("{{$elemento->idempleado}}");
            $("#remunerada").val("{{$elemento->remunerada}}");
            $("#ideps").val("{{$elemento->ideps}}");
            $("#idafp").val("{{$elemento->idafp}}");
            
         









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
