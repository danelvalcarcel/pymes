
@extends('layouts.app')

@section('content')
@include('layouts.menu.nomina.admin')
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">

            <div class="panel-heading">
                    <div style="font-size: 20px; display: inline-block; height: 100%; vertical-align: middle;">
                        Tipos de Nomina
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
            <form action="{{ route($ruta)}}" method="post">
                 {{ csrf_field() }}
                <div class="row">


                <div class="col-md-12" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="nombre">Nombre</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="nombre" type="text" name="nombre" value="{{$elemento->nombre}}"  placeholder="Nombres del Tipo de Nomina">
                    </div>
                </div>


                <div class="col-md-12" style="margin-top: 15px" >
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="descripcion">Descripcion</label>
                    </div>
                    <div class="col-md-6">
                        <textarea rows="5"  required class="form-control" id="descripcion" type="text" name="descripcion" value="{{$elemento->descripcion}}"  placeholder="Descripcion Tipo de Nomina">{{$elemento->descripcion}}</textarea>
                    </div>
                </div>

              





 
                        
                
                    <div class="col-sm-12" style="padding-top: 30px">
                                         @if($ruta =="tipos_nomina_update" )
                                         <div class="col-sm-6">
                                         <input type="hidden" name="id" value="{{$id}}">
                                        <input type="submit" id="save_elemento" value="Actualizar" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_tipos_nomina')}}" class="btn col-md-10 btn-warning col-md-offset-1 "  >
                                        Volver a Inicio
                                        </a>
                                        </div>
                                       @elseif($ruta =="tipos_nomina_create" )
                                       <div class="col-sm-6">
                                        <input type="submit" id="save_elmento" value="Crear" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_tipos_nomina')}}" class="btn btn-warning col-md-10 col-md-offset-1 "  >
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
        
       


         $("#subproceso_id").on("change", function(){

            $("#proceso_id").val($("#subproceso_id option:selected").attr("data-proceso"));
        
        });

         






    });
</script>
@endsection
