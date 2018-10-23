
@extends('layouts.app')

@section('content')
@include('layouts.menu.administracion.admin')
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">

            <div class="panel-heading">
                    <div style="font-size: 20px; display: inline-block; height: 100%; vertical-align: middle;">
                        Articulo
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
                            <label for="id_categoria"  class="col-md-4 form-control" style="border:none">Categoria</label>
                             </div>

                            <div class="col-md-6">
                                <select required  id="id_categoria" class="form-control" name="id_categoria" >
                                    @foreach($Categorias as $data)
                                    <option value="{{$data->id_categoria}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                 </div>


                 <div class="col-md-6" style="margin-top: 20px">
                            <div class="col-md-6">
                            <label for="id_medida"  class="col-md-4 form-control" style="border:none">Unidad</label>
                             </div>

                            <div class="col-md-6">
                                <select required  id="id_medida" class="form-control" name="id_medida" >
                                    @foreach($Medidas as $data)
                                    <option value="{{$data->id_medida}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                 </div>


                 <div class="col-md-6"  style="margin-top: 20px">
                    <div class="col-md-6">
                       <label class="form-control" style="border:none" for="valor_costo">Precio Compra Sin Iva</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="valor_costo" type="text" name="valor_costo" value="{{substr($elemento->valor_costo,0,-3)}}"  >
                    </div>
                </div>


                <div class="col-md-6"  style="margin-top: 20px">
                    <div class="col-md-6">
                       <label class="form-control" style="border:none" for="valor_iva">Valor Iva</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="valor_iva" type="text" name="valor_iva" value="{{substr($elemento->valor_iva,0,-3)}}" >
                    </div>
                </div>



                <div class="col-md-6"  style="margin-top: 20px">
                    <div class="col-md-6">
                       <label class="form-control" style="border:none" for="valor_total">Valor Total</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="valor_total" type="text" name="valor_total" value="{{substr($elemento->valor_total,0,-3)}}" >
                    </div>
                </div>


                <div class="col-md-6"  style="margin-top: 20px">
                    <div class="col-md-6">
                       <label class="form-control" style="border:none" for="valor_venta">Valor Venta</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="valor_venta" type="text" name="valor_venta" value="{{substr($elemento->valor_venta,0,-3)}}" >
                    </div>
                </div>


                 <div class="col-md-6"  style="margin-top: 20px">
                    <div class="col-md-6">
                       <label class="form-control" style="border:none" for="utilidad">Utilidad</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="utilidad" type="text" name="utilidad" value="{{substr($elemento->utilidad,0,-3)}}"  >
                    </div>
                </div>


                <div class="col-md-6"  style="margin-top: 20px">
                    <div class="col-md-6">
                       <label class="form-control" style="border:none" for="porcentaje_iva">Porcentaje Iva</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="porcentaje_iva" type="number" name="porcentaje_iva" value="{{$elemento->porcentaje_iva}}" >
                    </div>
                </div>


                <div class="col-md-6"  style="margin-top: 20px">
                    <div class="col-md-6">
                       <label class="form-control" style="border:none" for="porcentaje_descuento">Porcentaje Descuento</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="porcentaje_descuento" type="number" name="porcentaje_descuento" value="{{$elemento->porcentaje_descuento}}" >
                    </div>
                </div>

                <div class="col-md-6"  style="margin-top: 20px">
                    <div class="col-md-6">
                       <label class="form-control" style="border:none" for="valor_descuento">Valor Descuento</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="valor_descuento" type="text" name="valor_descuento" value="{{substr($elemento->valor_descuento,0,-3)}}" >
                    </div>
                </div>


                <div class="col-md-6"  style="margin-top: 20px">
                    <div class="col-md-6">
                       <label class="form-control" style="border:none" for="valor_pormayor">Valor Por Mayor</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="valor_pormayor" type="text" name="valor_pormayor" value="{{substr($elemento->valor_pormayor,0,-3)}}"  >
                    </div>
                </div>
                <div class="col-md-6"  style="margin-top: 20px">
                    <div class="col-md-6">
                       <label class="form-control" style="border:none" for="inicial">Cantidad Inicial</label>
                    </div>
                    <div class="col-md-6">
                        <input required class="form-control" id="inicial" type="number" name="inicial" value="{{$elemento->inicial}}"  >
                    </div>
                </div>



            

              





 
                        
                
                    <div class="col-sm-12" style="padding-top: 30px">
                                         @if($ruta =="MisArticulo_update" )
                                         <div class="col-sm-6">
                                         <input type="hidden" name="id" value="{{$id}}">
                                        <input type="submit" id="save_elemento" value="Actualizar" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_MisArticulo')}}" class="btn col-md-10 btn-warning col-md-offset-1 "  >
                                        Volver a Inicio
                                        </a>
                                        </div>
                                       @elseif($ruta =="MisArticulo_create" )
                                       <div class="col-sm-6">
                                        <input type="submit" id="save_elemento" value="Crear" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_MisArticulo')}}" class="btn btn-warning col-md-10 col-md-offset-1 "  >
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
        
       

         



        $("#id_categoria").val("{{$elemento->id_categoria}}")
        $("#id_medida").val("{{$elemento->id_medida}}")


                $("#valor_costo, #valor_iva, #valor_total, #valor_venta, #utilidad, #valor_descuento, #valor_pormayor").on({
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
        
         $("#valor_costo, #valor_iva, #valor_total, #valor_venta, #utilidad, #valor_descuento, #valor_pormayor").trigger("focusout")


            $("input#save_elemento").on("click", function(event){
            event.preventDefault();
            event.stopPropagation();
           var valor =$("#valor_costo").val() ;
           var nuevo_val = valor.replace(".","").replace(".","").replace(".","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","");
           $("#valor_costo").prop("type", "number");
           $("#valor_costo").val(parseFloat(nuevo_val))

            var valor =$("#valor_iva").val() ;
           var nuevo_val = valor.replace(".","").replace(".","").replace(".","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","");
           $("#valor_iva").prop("type", "number");
           $("#valor_iva").val(parseFloat(nuevo_val))

            var valor =$("#valor_total").val() ;
           var nuevo_val = valor.replace(".","").replace(".","").replace(".","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","");
           $("#valor_total").prop("type", "number");
           $("#valor_total").val(parseFloat(nuevo_val))

            var valor =$("#valor_venta").val() ;
           var nuevo_val = valor.replace(".","").replace(".","").replace(".","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","");
           $("#valor_venta").prop("type", "number");
           $("#valor_venta").val(parseFloat(nuevo_val))

            var valor =$("#utilidad").val() ;
           var nuevo_val = valor.replace(".","").replace(".","").replace(".","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","");
           $("#utilidad").prop("type", "number");
           $("#utilidad").val(parseFloat(nuevo_val))

            var valor =$("#valor_descuento").val() ;
           var nuevo_val = valor.replace(".","").replace(".","").replace(".","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","");
           $("#valor_descuento").prop("type", "number");
           $("#valor_descuento").val(parseFloat(nuevo_val))

            var valor =$("#valor_pormayor").val() ;
           var nuevo_val = valor.replace(".","").replace(".","").replace(".","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","");
           $("#valor_pormayor").prop("type", "number");
           $("#valor_pormayor").val(parseFloat(nuevo_val))

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
