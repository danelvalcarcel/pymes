
@extends('layouts.app')

@section('content')
@include('layouts.menu.maestros.admin')
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">

            <div class="panel-heading">
                    <div style="font-size: 20px; display: inline-block; height: 100%; vertical-align: middle;">
                        Fondo
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





                <div class="col-md-6" style="margin-top: 15px" >
                    <div class="col-md-6">
                       <label class="form-control" style="border:none" for="codigo">Codigo</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="codigo" type="text" name="codigo" value="{{$elemento->codigo}}" >
                    </div>
                </div>




                <div class="col-md-6" style="margin-top: 15px" >
                    <div class="col-md-6">
                       <label class="form-control" style="border:none" for="nombre">Nombre</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="nombre" type="text" name="nombre" value="{{$elemento->nombre}}" >
                    </div>
                </div>

                 <div class="col-md-6" style="margin-top: 20px">
                            <div class="col-md-6">
                            <label for="tipo"  class="col-md-4 form-control" style="border:none">Tipo</label>
                             </div>

                            <div class="col-md-6">
                                <select required  id="tipo" class="form-control" name="tipo" >
                                   <option value="1">Cuenta de Ahorros</option>
                                   <option value="2">Cuenta Corriente</option>
                                   <option value="3">Caja</option>
                                   <option value="4">Cdt</option>

                                </select>
                            </div>
                 </div>


                 <div class="col-md-6" style="margin-top: 20px">
                            <div class="col-md-6">
                            <label for="id_banco"  class="col-md-4 form-control" style="border:none">Banco</label>
                             </div>

                            <div class="col-md-6">
                                <select required  id="id_banco" class="form-control" name="id_banco" >
                                    @foreach($Bancos as $data)
                                    <option value="{{$data->idbanco}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                 </div>


                 <div class="col-md-6" style="margin-top: 20px">
                            <div class="col-md-6">
                            <label for="id_puc"  class="col-md-4 form-control" style="border:none">PUC</label>
                             </div>

                            <div class="col-md-6">
                                <select required  id="id_puc" class="form-control" name="id_puc" >
                                    @foreach($Pucs as $data)
                                    <option value="{{$data->id_cuenta}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                 </div>
                 <div class="col-md-6" style="margin-top: 15px" >
                    <div class="col-md-6">
                       <label class="form-control" style="border:none" for="inicial">Inicial</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="inicial" type="text" name="inicial" value="{{$elemento->codigo}}" >
                    </div>
                </div>

              





 
                        
                
                    <div class="col-sm-12" style="padding-top: 30px">
                                         @if($ruta =="Fondo_update" )
                                         <div class="col-sm-6">
                                         <input type="hidden" name="id" value="{{$id}}">
                                        <input type="submit" id="save_elemento" value="Actualizar" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Fondo')}}" class="btn col-md-10 btn-warning col-md-offset-1 "  >
                                        Volver a Inicio
                                        </a>
                                        </div>
                                       @elseif($ruta =="Fondo_create" )
                                       <div class="col-sm-6">
                                        <input type="submit" id="save_elemento" value="Crear" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Fondo')}}" class="btn btn-warning col-md-10 col-md-offset-1 "  >
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
        
       




        $("#id_banco").val("{{$elemento->id_banco}}")
        $("#id_puc").val("{{$elemento->id_puc}}")
        $("#tipo").val("{{$elemento->tipo}}")


                $("#inicial").on({
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
        
         $("#inicial").trigger("focusout")


            $("input#save_elemento").on("click", function(event){
            event.preventDefault();
            event.stopPropagation();
           var valor =$("#inicial").val() ;
           var nuevo_val = valor.replace(".","").replace(".","").replace(".","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","");
           $("#inicial").prop("type", "number");
           $("#inicial").val(parseFloat(nuevo_val))
            $("#form_sueldo").submit();
            })


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
