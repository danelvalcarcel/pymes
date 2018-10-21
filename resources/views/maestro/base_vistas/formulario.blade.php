
@extends('layouts.app')

@section('content')
@include('layouts.menu.maestros.admin')
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">

            <div class="panel-heading">
                    <div style="font-size: 20px; display: inline-block; height: 100%; vertical-align: middle;">
                        Eps
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



                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!-----------------------Campo Tipo Texto---------------------------->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->


                <div class="col-md-12" style="margin-top: 15px" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="codigo">Documento</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="codigo" type="text" name="codigo" value="{{$elemento->codigo}}" >
                    </div>
                </div>


                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!-----------------------Campo Tipo Texto---------------------------->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->




                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!-----------------------Campo Tipo numero---------------------------->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->


                <div class="col-md-12" style="margin-top: 15px" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="nit">Nit</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="nit" type="number" name="nit" value="{{$elemento->nit}}" >
                    </div>
                </div>


                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!-----------------------Campo Tipo Numero---------------------------->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->


                



                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!-----------------------Campo Tipo Fecha---------------------------->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->





                <div class="col-md-12" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="fecha_nacimiento">Fecha Nacimiento</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control"  id="fecha_nacimiento" type="date" name="fecha_nacimiento"  value="{{$elemento->fecha_nacimiento}}"  >
                    </div>
                </div>

                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!-----------------------Campo Tipo Fecha---------------------------->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->




                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!-----------------------Campo Tipo lista deplegable----------------->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->

                


                <div class="col-md-12" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="genero"  class="col-md-4 form-control" style="border:none">Genero</label>
                             </div>

                            <div class="col-md-6">
                                <select required  id="genero" class="form-control" name="genero" >
                                    <option value="1">Masculino</option>
                                    <option value="0">Femenino</option>
                                </select>
                            </div>
                 </div>






                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!-----------------------Campo Tipo lista deplegable----------------->
                <!--***************************************************************-->
                <!--***************************************************************-->
                <!--***************************************************************-->

 
                        
                
                    <div class="col-sm-12" style="padding-top: 30px">
                                         @if($ruta =="Eps_update" )
                                         <div class="col-sm-6">
                                         <input type="hidden" name="id" value="{{$id}}">
                                        <input type="submit" id="save_elemento" value="Actualizar" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Eps')}}" class="btn col-md-10 btn-warning col-md-offset-1 "  >
                                        Volver a Inicio
                                        </a>
                                        </div>
                                       @elseif($ruta =="Eps_create" )
                                       <div class="col-sm-6">
                                        <input type="submit" id="save_elemento" value="Crear" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Eps')}}" class="btn btn-warning col-md-10 col-md-offset-1 "  >
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