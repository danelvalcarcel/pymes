
@extends('layouts.app')

@section('content')
@include("layouts.menu.thumano.admin")
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div style="font-size: 20px; display: inline-block; height: 100%; vertical-align: middle;">
                        Eventos
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
                       <label class="form-control" style="border:none" for="nombres">Nombre</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="nombre" type="text" name="nombre" value="{{$elemento->nombre}}"  >
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
                       <label class="form-control" style="border:none" for="forma">Obligatorio</label>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control" name="forma" id="forma">
                            <option value="1">Si</option>
                            <option value="0">No</option>
                            
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





                   <div class="col-sm-12">
                     @if(count($elemento->empleados)>0)
                    <div id="documentos_div" class="col-md-6 col-md-offset-3 col-sm-12 panel panel-success" style="background: #2d2d2d; margin-top: 20px; background-clip: padding-box;
    border: 5px solid transparent; height: 100%">
     
                        <div style="text-align: center;"><h5>Documentos</h5></div>
                           

                                     <div class="row hidden-xs">
                                     
                                            <div class="col-md-5 " style="margin-left: ">
                                                <div class="col-sm-3"><h5>Empleado</h5></div>
                                            </div>
                                           
                                            <div class="col-md-5">
                                                <div class="col-sm-8" style="text-align: center;"><h5>Cargo</h5></div>
                                            </div>

                                            <div class=" col-md-2">
                                                <div class="col-sm-1" ><h5><span class="" aria-hidden="true"></span></h5></div>
                                            </div>

                                        
                                    
                                    </div>
                            
                                        <!--fila--------->
                                    
                                    @foreach($elemento->empleados as $empleado)
                                        <div class="row">
                                          <div class="col-sm-5" style="margin-top: 5px ">
                                              <div  >
                                              <h5>{{$empleado->empleado->nombres}}</h5>
                                              </div>
                                        </div>
                                          <div class="col-sm-4"  style="margin-top: 5px ">
                                                <h5>Cargo</h5>
                                         </div>
                                          <div class=" col-sm-3"  style="margin-top: 5px ">
                                           <a class="btn btn-xs btn-danger"><i  class="glyphicon glyphicon-remove-circle" aria-hidden="true"></i></a>
                                         </div>
                                        </div>
                                        @endforeach
                                       
                    
                   
                    </div> 
                     @endif              
                 </div>


                 @if(count($elemento->empleados)>0)
                 <div>
                        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Agregar Mas empleados al Evento
                        </a>
                </div>

                 <div class="col-sm-12" class="collapse" id="collapseExample" aria-expanded="false" style="height: 0; overflow: hidden;">
                 @else
                 <div class="col-sm-12">
                @endif


                    <div class="col-md-12 col-sm-12 panel panel-success" style="background: #2d2d2d; margin-top: 20px; background-clip: padding-box; border: 5px solid transparent; min-height: 400px">
                        <div style="text-align: center;"><h5>Documentos</h5></div>
                        <div class="row" style="padding: 0 2px 0 2px">
                                    <div class="row hidden-xs">
                                     
                                            <div class="col-md-6 col-md-offset-3" style="margin-left: ">
                                                <div class="col-sm-12"><h5>Empleado</h5></div>
                                            </div>
                                           
                                          
                                        
                                    
                                    </div>
                            
                                        <!--fila--------->
                                    @for ($i = 0; $i < 6; $i++)
                                        <div class="row">
                                          <div class="col-md-6 col-md-offset-3" style="margin-top: 5px ">
                                              <div  >
                                              <select  id="idempleado_{{$i}}" class="form-control" name="idempleado_{{$i}}" >
                                                    <option value="0">Selecciona una opcion</option>}
                                                    option
                                                    @foreach($Empleados as $data)
                                                    <option value="{{$data->idempleado}}">{{$data->nombres}} {{$data->apellidos}}</option>
                                                    @endforeach
                                                </select>
                                              </div>
                                        </div>
                                        </div>
                                    @endfor
                                        <!--fila--------->
                         </div>
                    </div>                     
                 </div>





















































                
                    <div class="col-sm-12" style="padding-top: 30px">
                                         @if($ruta =="Evento_update" )
                                         <div class="col-sm-6">
                                         <input type="hidden" name="id" value="{{$id}}">
                                        <input type="submit" id="save_elemento" value="Actualizar" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Evento')}}" class="btn col-md-10 btn-warning col-md-offset-1 "  >
                                        Volver a Inicio
                                        </a>
                                        </div>
                                       @elseif($ruta =="Evento_create" )
                                       <div class="col-sm-6">
                                        <input type="submit" id="save_elemento" value="Crear" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Evento')}}" class="btn btn-warning col-md-10 col-md-offset-1 "  >
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
        
       
            $("#idtipoEvento").val("{{$elemento->idtipoEvento}}");
            $("#idempleado").val("{{$elemento->idempleado}}");
            $("#remunerada").val("{{$elemento->remunerada}}");
            $("#forma").val("{{$elemento->forma}}");
            
         









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
