
@extends('layouts.app')

@section('content')
@include('layouts.menu.nomina.admin')
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading">
                    <div style="font-size: 20px; display: inline-block; height: 100%; vertical-align: middle;">
                        Cargos
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
            <form id="form_sueldo" action="{{ route($ruta)}}" method="post">
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


                 <div class="col-md-12"  style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="sueldo">Sueldo</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="sueldo" type="text" name="sueldo" value="{{substr($elemento->sueldo,0,-3)}}"  placeholder="Nombres del Tipo de Nomina">
                    </div>
                </div>



                <div class="col-md-12" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="idtiponomina"  class="col-md-4 form-control" style="border:none">Tipo de Nomina</label>
                             </div>

                            <div class="col-md-6">
                                <select  id="idtiponomina" class="form-control" name="idtiponomina" >
                                    <option value="0">Selecciona una opcion</option>}
                                    option
                                    @foreach($tipos_nomina as $data)
                                    <option value="{{$data->idtiponomina}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


              





 
                        
                
                    <div class="col-sm-12" style="padding-top: 30px">
                                         @if($ruta =="cargo_update" )
                                         <div class="col-sm-6">
                                         <input type="hidden" name="id" value="{{$id}}">
                                        <input type="submit" id="save_elemento" value="Actualizar" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_cargo')}}" class="btn col-md-10 btn-warning col-md-offset-1 "  >
                                        Volver a Inicio
                                        </a>
                                        </div>
                                       @elseif($ruta =="cargo_create" )
                                       <div class="col-sm-6">
                                        <input type="submit" id="save_elemento" value="Crear" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_cargo')}}" class="btn btn-warning col-md-10 col-md-offset-1 "  >
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
        
       
            $("#idtiponomina").val("{{$elemento->idtiponomina}}");
         


           $("input#save_elemento").on("click", function(event){
            event.preventDefault();
            event.stopPropagation();
           var valor =$("#sueldo").val() ;
           var nuevo_val = valor.replace(".","").replace(".","").replace(".","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","");
           $("#sueldo").prop("type", "number");
           $("#sueldo").val(parseFloat(nuevo_val))
            $("#form_sueldo").submit();
            })
        
        $("#sueldo").on({
                "focus": function (event) {
                    $(event.target).select();
                },
                "focusout": function (event) {
                    $(event.target).val(function (index, value ) {
                        return value.replace(/\D/g, "")
                                    .replace(/([0-9])([0-9]{3})$/, '$1.$2')
                                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                    });
                },
                "keyup": function (event) {
                    $(event.target).val(function (index, value ) {
                        return value.replace(/\D/g, "")
                                    .replace(/([0-9])([0-9]{3})$/, '$1.$2')
                                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                    });
                }
        });
        
         $("#sueldo").trigger("focusout")



    });
</script>
@endsection
