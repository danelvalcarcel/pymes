
@extends('layouts.app')

@section('content')
@include('layouts.menu.maestros.admin')
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">

            <div class="panel-heading">
                    <div style="font-size: 20px; display: inline-block; height: 100%; vertical-align: middle;">
                        Sedes
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



                <div class="col-md-12" style="margin-top: 15px" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="nombre">Nombre</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="nombre" type="text" name="nombre" value="{{$elemento->nombre}}" >
                    </div>
                </div>



                <div class="col-md-12" style="margin-top: 15px" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="codigo">Codigo</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="codigo" type="text" name="codigo" value="{{$elemento->codigo}}" >
                    </div>
                </div>


                <div class="col-md-12" style="margin-top: 15px" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="descripcion">Descripcion</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="descripcion" type="text" name="descripcion" value="{{$elemento->descripcion}}" >
                    </div>
                </div>



                <div class="col-md-12" style="margin-top: 15px" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="direccion">Direccion</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="direccion" type="text" name="direccion" value="{{$elemento->direccion}}" >
                    </div>
                </div>



                <div class="col-md-12" style="margin-top: 15px" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="telefono">Telefono</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="telefono" type="text" name="telefono" value="{{$elemento->telefono}}" >
                    </div>
                </div>



                <div class="col-md-12" style="margin-top: 15px" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="contacto">Contacto</label>
                    </div>
                    <div class="col-md-6">
                        <textarea class="form-control" rows="5" id="contacto" type="text" name="contacto" value="{{$elemento->contacto}}" >
                            {{$elemento->contacto}}
                        </textarea>
                       
                    </div>
                </div>



                <div class="col-md-12" style="margin-top: 15px" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="contacto">Contacto</label>
                    </div>
                    <div class="col-md-6">
                        <select id="id_establecimiento" class="form-control" name="id_establecimiento" >
                                    @foreach($Entidades as $data)
                                    <option  value="{{$data->id_establecimiento}}">{{$data->nombre}}</option>
                                    @endforeach
                        </select>
                       
                    </div>
                </div>


                



                




              





 
                        
                
                    <div class="col-sm-12" style="padding-top: 30px">
                                         @if($ruta =="Sede_update" )
                                         <div class="col-sm-6">
                                         <input type="hidden" name="id" value="{{$id}}">
                                        <input type="submit" id="save_elemento" value="Actualizar" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Sede')}}" class="btn col-md-10 btn-warning col-md-offset-1 "  >
                                        Volver a Inicio
                                        </a>
                                        </div>
                                       @elseif($ruta =="Sede_create" )
                                       <div class="col-sm-6">
                                        <input type="submit" id="save_elemento" value="Crear" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Sede')}}" class="btn btn-warning col-md-10 col-md-offset-1 "  >
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
