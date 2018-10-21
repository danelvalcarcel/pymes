
@extends('layouts.app')

@section('content')
@include('layouts.menu.ventasc.admin')
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">
    <ul class="nav nav-tabs " id="pestanas_facturacion">
        <li id="pestana_facturacion" data-div="contenido_facturacion" data-no_div='contenido_registrar_cliente' class="active"><a  >Facturacion</a></li>


    </ul>

    <div data-no_li="pestana_facturacion" id="contenido_registrar_cliente">

    </div>
    </div>
    <div data-no_li="pestana_register" id="contenido_facturacion" class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ route('Facturacion.create') }}">
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('cedula') ? ' has-error' : '' }}">
                                    <div class="col-md-3">
                                        <input id="consecutivo" style="padding: 0; text-align: center" type="text" disabled class="form-control" name="consecutivo" value="{{ $operacion->consecutivo }}" required autofocus>

                                    </div>
                                    <label id="milabel" for="cedula" class="col-md-2 control-label">Cedula</label>

                                    <div class="col-md-7">
                                        <input id="cedula" type="text" class="form-control" name="cedula" value="{{$operacion->cliente->cedula }}" required autofocus>
                                        <input type="hidden" value="1" name="tipo_operacion" id="tipo_operacion">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div id="btn_fact_prod" class="col-md-12">
                                    <button type="button"  class="btn btn-primary col-md-6 col-md-offset-1" id="btn_agregar_prod" data-toggle="modal" data-target="#myModal">
                                        Agregar
                                    </button>
                                    <button type="button"    class="btn btn-primary col-md-5" id="btn_facturar" data-toggle="modal" data-target="#facturarModal">
                                        Facturar
                                    </button>

                                </div>

                            </div>
                        </div>






                        <div class="row">
                            <div class="col-md-6 " id="cont_desc_cliente" >
                            <div class="form-control "  id="descripcion_cliente" style="height: auto">

                            </div>


                            </div>
                            <div id="text_area_descri" class="col-md-6">
                                <textarea class="form-control"  style="border-color: #2d2d2d" rows="3" name="comentario" id="comentario">
                                {{ trim($operacion->observacion)}}

                                </textarea>
                            </div>

                        </div>






















                        <div class="row" style="margin-top: 10px">
                            <div class="col-md-9">
                                <div class="panel panel-primary">
                                    <div class="panel-heading" style="text-align: center">
                                        Lista de Productos
                                    </div>
                                    <div class="panel-body">
                                        <table id="factura_deta" style="background-color: #2d2d2d" class="table">
                                            <thead style="background-color:  #2d2d2d">
                                            <tr>
                                                <th style="background-color:  #2d2d2d">Codigo</th>
                                                <th style="background-color:  #2d2d2d">Nombre</th>
                                                <th style="background-color:  #2d2d2d">Cant</th>
                                                <th style="background-color:  #2d2d2d">Precio</th>
                                                <th style="background-color:  #2d2d2d">Desct</th>

                                                <th style="background-color:  #2d2d2d">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($operacion->inventarios as $inventario)

                                                <tr data-id_inv="{{$inventario->id}}" id="{{$inventario->codigo}}">
                                                    <td id="codigo">{{$inventario->codigo}}</td>
                                                    <td id="nombre">{{$inventario->producto->nombre}}</td>
                                                    <td id="cantidad" data-max_canti="{{$inventario->cantidad }}">{{number_format($inventario->pivot->cantidad_inv,0)}}</td>
                                                    <td id="precio_prod">{{number_format( $inventario->producto->precio_venta,2)}}</td>
                                                    <td id="descuento_aplicado" data-descuento="{{$inventario->pivot->descuento}}">{{$inventario->pivot->descuento}}%</td>
                                                    <td data-descuento="{{$inventario->pivot->descuento}}" id="total">
                                                        <div class="row">
                                                            <div class="col-md-9" style="padding-right: 0" id="total_val">{{number_format( $inventario->pivot->dinero,2)}}</div>
                                                            <div class="col-md-2" style="padding-left: 0; background-color:  #2d2d2d" >
                                                                <span class="glyphicon glyphicon-option-vertical dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" aria-hidden="true"></span>
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="background-color:  #2d2d2d">
                                                                    <li><a id="descuento" href="{{$inventario->codigo}}">Modificar</a></li>
                                                                    <li><a id="eliminar" href="{{$inventario->codigo}}">Eliminar</a></li>
                                                                </ul>
                                                            <div/>
                                                            </div>
                                                        </div>
                                                    </td>

                                    </tr>
                                          @endforeach






                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        <div class="col-md-3">
                            <div class="panel panel-success">
                                <div class="panel-heading" style="text-align: center;">Descripcion</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5>Base</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <h5><strong>$ </strong><strong id="base_factura">{{number_format((($operacion->total)/(1.19)),2)}}</strong></h5>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Impuesto</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <h5><strong>$ </strong><strong id="impuesto_factura">{{number_format(((($operacion->total)/(1.19))*(0.19)),2) }}</strong></h5>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Total</h5>
                                        </div>
                                        <div class="col-md-8">
                                            <h5><strong>$ </strong><strong id="total_factura">{{number_format($operacion->total,2)}}</strong></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>





                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
            </div>
        </div>
    </div>
    <div class=" modal fade " id="myModal"  tabindex="-1"  style="overflow-y: scroll" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="width: 100%" role="document">
            <div class="modal-content col-md-10 col-md-offset-1" >
                <div style="padding: 0" class="modal-header">
                    <button  type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   <strong><h4  class="modal-title" style="text-align: center; margin: 0" id="myModalLabel">Agregar Productos</h4></strong>
                </div>
                <div class="modal-body">
                   <div class="row " style=" border-radius: 5px; padding-bottom: 10px; padding-top: 10px">
                       <div class="form-group">
                           <div class="col-md-4 col-md-offset-3">
                                    <input title="producto" type="text"  name="producto" value="" id="producto" class="form-control">

                           </div>
                           <div class="col-md-2">
                               <button id="mostrar_opciones"  class="col-md-12 btn btn-success">Ver mas</button>
                           </div>

                           <div id="opciones_busquedad" class="col-md-12 hide" style="padding-top: 5px; padding-bottom: 5px;">
                               <div class="col-md-4 ">
                                   <p style="text-align: center;"> <strong  >Categoria</strong></p>
                                   <select class="form-control ">
                                       <option>Opcion 1</option>
                                   </select>
                               </div>
                               <div class="col-md-4">
                                   <p style="text-align: center;"> <strong >Marca</strong></p>
                                   <select class="form-control ">
                                       <option>Opcion 1</option>
                                   </select>
                               </div>
                               <div class="col-md-4">
                                   <p style="text-align: center;"> <strong  >Ubicacion</strong></p>
                                   <select class="form-control ">
                                       <option>Opcion 1</option>
                                   </select>
                               </div>





                           </div>
                       </div>


                   </div>

                    <div class="row" style="margin-top: 4px">
                        <div  id="cont_prod_busc">
                            <div class="row" id="cont_prod_busc_row">
                               <!-- <div class="col-md-3" >
                                    <img class="col-md-12" height="150px" src="img/bombillo.jpg">
                                    <div class="col-md-12" style="text-align: center">
                                        <h4>Nombre del Producto</h4>
                                        <div id="desc_prod1" class="desc_ocul" data-element ="1" style="text-align: justify; height: 60px; overflow: hidden; text-overflow: ellipsis">Esta es la Descripcion del producto
                                            Esta es la Descripcion deEsta es la Descripcion deEsta es la Descripcion del producto
                                            Esta es la Descripcion deEsta es la Descripcion de</div>
                                        <div class="row" style="margin-top: 4px">
                                            <p class="col-md-6"  ><strong>Ubicacion</strong></p>
                                            <div class="col-md-6">
                                                <p style="text-align: left">Bodega 2</p>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <p class="col-md-6" style="padding: 6px 12px;" ><strong>15.000 und</strong></p>
                                            <div class="col-md-6">
                                                <input class="form-control" type="number" name="cantidad_prop">
                                            </div>

                                        </div>

                                        <p><strong>$ 15.000</strong> </p>
                                        <div class="row">
                                            <button type="button"  class="btn btn-primary col-md-8 col-md-offset-2" id="btn_agregar_prod_conse">
                                                Agregar
                                            </button>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-3" >
                                    <img class="col-md-12" height="150px" src="img/bombillo.jpg">
                                    <div class="col-md-12" style="text-align: center">
                                        <h4>Nombre del Producto</h4>
                                        <div id="desc_prod2" class="desc_ocul" data-element ="2" style="text-align: justify; height: 60px; overflow: hidden; text-overflow: ellipsis">Esta es la Descripcion del producto
                                            Esta es la Descripcion deEsta es la Descripcion deEsta es la Descripcion del producto
                                            Esta es la Descripcion deEsta es la Descripcion de</div>
                                        <div class="row" style="margin-top: 4px">
                                            <p class="col-md-6"  ><strong>Ubicacion</strong></p>
                                            <div class="col-md-6">
                                                <p style="text-align: left">Bodega 2</p>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <p class="col-md-6" style="padding: 6px 12px;" ><strong>15.000 und</strong></p>
                                            <div class="col-md-6">
                                                <input class="form-control" type="number" name="cantidad_prop">
                                            </div>

                                        </div>

                                        <p><strong>$ 15.000</strong> </p>
                                        <div class="row">
                                            <button type="button"  class="btn btn-primary col-md-8 col-md-offset-2" id="btn_agregar_prod_conse">
                                                Agregar
                                            </button>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-3" >
                                    <img class="col-md-12" height="150px" src="img/bombillo.jpg">
                                    <div class="col-md-12" style="text-align: center">
                                        <h4>Nombre del Producto</h4>
                                        <div id="desc_prod3" class="desc_ocul" data-element ="3" style="text-align: justify; height: 60px; overflow: hidden; text-overflow: ellipsis">Esta es la Descripcion del producto
                                            Esta es la Descripcion deEsta es la Descripcion deEsta es la Descripcion del producto
                                            Esta es la Descripcion deEsta es la Descripcion de</div>
                                        <div class="row" style="margin-top: 4px">
                                            <p class="col-md-6"  ><strong>Ubicacion</strong></p>
                                            <div class="col-md-6">
                                                <p style="text-align: left">Bodega 2</p>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <p class="col-md-6" style="padding: 6px 12px;" ><strong>15.000 und</strong></p>
                                            <div class="col-md-6">
                                                <input class="form-control" type="number" name="cantidad_prop">
                                            </div>

                                        </div>

                                        <p><strong>$ 15.000</strong> </p>
                                        <div class="row">
                                            <button type="button"  class="btn btn-primary col-md-8 col-md-offset-2" id="btn_agregar_prod_conse">
                                                Agregar
                                            </button>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-3" >
                                    <img class="col-md-12" height="150px" src="img/bombillo.jpg">
                                    <div class="col-md-12" style="text-align: center">
                                        <h4>Nombre del Producto</h4>
                                        <div id="desc_prod4" class="desc_ocul" data-element ="4" style="text-align: justify; height: 60px; overflow: hidden; text-overflow: ellipsis">Esta es la Descripcion del producto
                                            Esta es la Descripcion deEsta es la Descripcion deEsta es la Descripcion del producto
                                            Esta es la Descripcion deEsta es la Descripcion de</div>
                                        <div class="row" style="margin-top: 4px">
                                            <p class="col-md-6"  ><strong>Ubicacion</strong></p>
                                            <div class="col-md-6">
                                                <p style="text-align: left">Bodega 2</p>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <p class="col-md-6" style="padding: 6px 12px;" ><strong>15.000 und</strong></p>
                                            <div class="col-md-6">
                                                <input class="form-control" type="number" name="cantidad_prop">
                                            </div>

                                        </div>

                                        <p><strong>$ 15.000</strong> </p>
                                        <div class="row">
                                            <button type="button"  class="btn btn-primary col-md-8 col-md-offset-2" id="btn_agregar_prod_conse">
                                                Agregar
                                            </button>
                                        </div>
                                    </div>


                                </div>-->
                                        <table  class=" col-md-12 table table-bordered  table-striped">



                                        </table>



                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>






    <div class="modal fade" id="descModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding-bottom: 0;">
                    <h5 class="modal-title" style="text-align: center">Descripcion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding-top: 0">
                    <p id="descr_mostrar" style="margin-top: 0"></p>
                </div>

            </div>
        </div>
    </div>




    <div class="modal fade" id="inforModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-danger" style="padding-bottom: 0; padding-top: 10px">
                    <h4 class="modal-title" style="text-align: center"><strong>
                            Información
                        </strong></h4>
                    <button type="button" class="close" id="cerrar_info"  aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  bg-danger" style="padding-top: 0">
                    <strong> <p id="infor_mostrar" style=" font-weight:bolder;text-align: center;margin-top: 0; color: #000">

                    </p></strong>
                    <div class="col-md-6 col-md-offset-3" id="estado_operacion" ></div>
                </div>

            </div>
        </div>
    </div>





    <div class="modal fade" id="descuentocModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding-bottom: 0;">
                    <h5 class="modal-title" style="text-align: center">Descuentos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding-top: 0">
                    <div class="row">
                        <label id='milabel' for='codigo_des' class='col-md-5 control-label'>Codigo</label>

                        <div class='col-md-4'>
                            <input id='codigo_des' disabled   type='text' class='form-control' name='codigo_des'>

                        </div>


                        <label id='milabel' for='nombre_des' class='col-md-5 control-label'>Nombre</label>

                        <div class='col-md-4'>
                            <input id='nombre_des' disabled type='text' class='form-control' name='nombre_des'>

                        </div>


                        <label id='milabel' for='precio_des' class='col-md-5 control-label'>Precio</label>

                        <div class='col-md-4'>
                            <input id='precio_des' disabled  type='text' class='form-control' name='precio_des'>

                        </div>

                        <label id='milabel' for='cantidad_des' class='col-md-5 control-label'>Cantidad</label>

                        <div class='col-md-4'>
                            <input id='cantidad_des' type='number' min="1" class='form-control' name='cantidad_des'>

                        </div>


                        <label id='milabel' for='descuento_des' class='col-md-5 control-label'>Descuento</label>

                        <div class='col-md-4'>
                            <input id='descuento_des' min="0"  type='number' class='form-control' name='descuento_des'>

                        </div>


                        <label id='milabel' for='total_des' class='col-md-5 control-label'>Total</label>

                        <div class='col-md-4'>
                            <input id='total_des' disabled type='text' class='form-control' name='total_des'>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cerrar_desc" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button  id="guardar_des" type="button" class="btn btn-primary">Save changes</button>
                </div>

            </div>
        </div>
    </div>





    <div class="modal fade " id="facturarModal">
        <div class="modal-dialog  " style="width: 100%" role="document">
            <div class="modal-content col-md-8 col-md-offset-2">
                <div class="modal-header" style="padding-bottom: 0;">
                    <h5 class="modal-title" style="text-align: center">Facturar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding-top: 0">

                    <div id="opciones_caja" class="col-md-12" style="padding-top: 5px; padding-bottom: 5px;">
                        <div class="col-md-3 ">

                            <select id="opciones_caja_selec" class="form-control ">
                                <option value="1">Caja 1</option>
                                <option value="2">Caja 2</option>
                                <option value="3">Caja 3</option>
                            </select>
                        </div>
                        <div class="col-md-3 ">

                            <select id="tipo_pago_selec" class="form-control ">
                                <option value="1">Contado</option>
                                <option value="2">Credito</option>
                                <option value="3">Tarjeta Credito</option>
                                <option value="4">Tarjeta Debito</option>

                            </select>
                        </div>
                        <div class="col-md-3">

                            <input class="form-control" data-dinero_caja="" type="text" name="dinero_caja" id="dinero_caja">
                        </div>
                        <div class="col-md-3">

                            <button id="btn_agregar_caja" class="btn form-control btn-success">Agregar</button>
                        </div>


                </div>
                    <div class="col-md-12" style="margin-top: 10px; margin-bottom: 15px ">
                        <div class="row">
                            <table id="tabla_caja" class="table-bordered col-md-10 col-sm-12 col-xs-12 col-md-offset-1" >
                                <thead style=" text-align: center">
                                <tr>
                                <td><strong>Caja</strong></td>
                                    <td><strong>Tipo Pago</strong></td>
                                <td><strong>Dinero</strong></td>
                                <td><strong>Porc</strong></td>
                                    <td><strong>--</strong></td>
                                </tr>
                                </thead>
                                <tbody style=" text-align: center">

                                </tbody>
                            </table>
                        </div>

                        <div id="progreso" style=" margin-top:10px; : 0; height: 10px; "></div>

                    </div>

                <div class=" modal-footer">

                    <button type="button" id="cerrar_factura" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button  id="guardar_factura" type="button" class="btn btn-primary">Confirmar</button>
                </div>

            </div>
        </div>
    </div>
@endsection
@section("script")
    <script>
        function cargar_cliente(){
            var cedula = $("#cedula").val();


                $.ajax({
                    type:"Get",
                    dataType:"json",
                    url:"/Clientes"+"/"+ cedula+"/"+"{{ Auth::user()->id_establecimiento}}",
                    success: function(resp){
                        console.log(resp.length);
                        if(resp.length===0){
                            $("ul#pestanas_facturacion li ").css("font-weight","normal");
                            if($("li#pestana_register").length>0){
                                $("li#pestana_register").css("font-weight","bolder");
                                $("#contenido_facturacion").slideUp(500);
                                $("#contenido_registrar_cliente").slideDown(500);
                                $("#cont_desc_cliente").slideUp(500);
                                $("#text_area_descri").slideUp(500);
                                return
                            }
                            $("#pestanas_facturacion").append("<li id='pestana_register' style='font-weight: bolder' data-div='contenido_registrar_cliente' data-no_div='contenido_facturacion' class='active'><a  >Creacion Cliente <span data-id='pestana_register' class='glyphicon glyphicon-remove' aria-hidden='true'></span> </a> </li>");
                            $("#contenido_registrar_cliente").append("<iframe class='col-md-12' height='600px' src='{{Route("Cliente2.index2")}}'></iframe>");
                            $("#contenido_facturacion").slideUp(500);
                            $("#contenido_registrar_cliente").slideDown(500);
                            $("#cont_desc_cliente").slideUp(500);
                            $("#text_area_descri").slideUp(500);

                            return;
                        }
                        var datos_cliente = resp[0];
                        // console.log(resp);
                        // console.log(datos_cliente["firts_name"]);
                        $("#descripcion_cliente").empty();
                        $("#descripcion_cliente").css('border',"none");
                        $("#descripcion_cliente").css('font-weight',"bolder");
                        $("#cont_desc_cliente").show();
                        $("#cont_desc_cliente").slideUp(300);
                        var agregar = "<table> <tr class='row'><td class='col-md-3'> Nombre: </td><td    class='col-md-9'>"+datos_cliente["firts_name"]+" " + datos_cliente["last_name"]+"</td></tr>";
                        agregar += "<tr class='row'><td class='col-md-3'> Celular: </td><td   class='col-md-9'>"+datos_cliente["celular_1"] + "   "+ datos_cliente["celular_2"]+"</td></tr>";
                        agregar +="<tr class='row'><td class='col-md-3'>Direccion: </td><td  class='col-md-9'>"+datos_cliente["direccion"] + " - "+ datos_cliente["municipio"]+"</td></tr>";
                        agregar +="</table>";
                        agregar +="<input type='hidden' name='id_cliente' id='id_cliente' value='"+datos_cliente["id"] +"'>";
                        $("#descripcion_cliente").append(agregar);
                        $("#cont_desc_cliente").slideDown(500);
                        $("#text_area_descri").slideDown(500);


                    }});


        }
        $(document).on("ready", function (e) {
            var lista_prod=[];
            var lista_prod_id=[];

            cargar_cliente();





            $("#mostrar_opciones").on("click", function(e){
                $("#opciones_busquedad").removeClass("hide").slideDown(400);
            });
            $("#cerrar_info").on("click", function(e){
                $("#inforModal").modal("hide");
            });

            $("#factura_deta").on("click","#eliminar", function (e) {
                e.preventDefault();
                var id_producto =$(this).attr("href");
                $("tr#"+id_producto).animate({
                    opacity: 0.25,
                    backgroundColor: "#D27185",
                    left: "+=50",
                    height: "toggle"
                }, 800, function() {
                    $("tr#"+id_producto).remove();
                    recalcular();

                });

            });





            $("#tabla_caja").on("click","#eliminar_caja", function (e) {
                e.preventDefault();
                var id_producto =$(this).attr("href");
                $("tr#"+id_producto).animate({
                    opacity: 0.25,
                    backgroundColor: "#D27185",
                    left: "+=50",
                    height: "toggle"},500, function () {
                    $("tr#"+id_producto).remove();
                    progreso(id_producto);
                });




            });




            $("button#guardar_des").on("click", function(e){
                var descuento =parseFloat($("input#descuento_des").val());
                $("input#descuento_des").val(descuento);
                if( $("input#cantidad_des").val()<1||$("input#descuento_des").val()<0||$("input#descuento_des").val()>100){

                    $("p#infor_mostrar").empty();
                    $("p#infor_mostrar").text("Verifica Los Valores del Descuento y Cantidad");
                    $("#inforModal").modal().appendTo("#descuentocModal");


                    return;
                }
                var valor =$("tr#"+$("input#codigo_des").val()+">td#cantidad").attr("data-max_canti");
                if( $("input#cantidad_des").val()> parseFloat(valor)){
                    $("p#infor_mostrar").empty();
                   // alert("cantidad "+$("input#codigo_des").val());

                    //alert("cantidad "+$("input#cantidad_des").val());
                    //alert("cantidad max se paso "+valor);
                    $("p#infor_mostrar").text("La Cantidad a Facturar no esta Disponible");
                    $("#inforModal").modal().appendTo("#descuentocModal");
                  return;
                }
                var descuento_redondeado = parseFloat($("input#descuento_des").val()).toFixed(2);
                var precio = $("input#precio_des").val();
            var total_final =number_format_coma(($("input#cantidad_des").val() * parseFloat(precio.replace(",","")))- ($("input#cantidad_des").val() *  parseFloat(precio.replace(",","")) * (descuento_redondeado/100)),2);



                $("tr#"+$("input#codigo_des").val()+">td#cantidad").text( $("input#cantidad_des").val());
                $("tr#"+$("input#codigo_des").val()+">td#descuento_aplicado").text(descuento_redondeado +"%").attr("data-descuento",(descuento_redondeado));
                $("tr#"+$("input#codigo_des").val()+">td#total>div>div#total_val").text( total_final);
                $("tr#"+$("input#codigo_des").val()+">td#total").attr("data-descuento", descuento_redondeado);

                $("#cerrar_desc").click();
                recalcular();
            });

            $("#factura_deta").on("click","#descuento", function (e) {
                e.preventDefault();

                var id_producto =$(this).attr("href");
                var codigo =$("tr#"+id_producto+">td#codigo").text();
                var nombre =$("tr#"+id_producto+">td#nombre").text();
                var cantidad =$("tr#"+id_producto+">td#cantidad").text();
                var precio_prodo =$("tr#"+id_producto+">td#precio_prod").text();
                var total =$("tr#"+id_producto+">td#total>div>div#total_val").text();
                var descuento =$("tr#"+id_producto+">td#total").attr("data-descuento");


                $("input#codigo_des").val(codigo);
                $("input#nombre_des").val(nombre);
                $("input#cantidad_des").val(cantidad);
                $("input#precio_des").val(precio_prodo);
                $("input#descuento_des").val(descuento);
                $("input#total_des").val(total);

                $("#descuentocModal").modal();


            });
            $("#cont_prod_busc_row").on("click","#btn_agregar_prod_conse", function (e) {
                var producto =$(this).attr("data-element");
                if($("#cantidad_prop_"+producto+"").val()<=0){

                    $("p#infor_mostrar").empty();
                    $("p#infor_mostrar").text("El Valor Debe Ser Mayor que Cero");
                    $("#inforModal").modal();

                    $("#cantidad_prop_"+producto+"").val("");
                    return;
                }

                    if($("tr#"+$("#codigo_"+producto+"").text()+"").attr("id")=== $("#codigo_"+producto+"").text()){
                        $("p#infor_mostrar").empty();
                        $("p#infor_mostrar").text("Ya Agrego este Producto, Modifiquelo o Eliminelo");
                        $("#inforModal").modal();

                        return;
                    }

                    if($("#cantidad_prop_"+producto+"").val() > parseFloat($("strong#inventario_prod_"+producto+"").text())){
                        $("p#infor_mostrar").empty();
                        $("p#infor_mostrar").text("La Cantidad Disponible es Menor");
                        $("#inforModal").modal();
                       return;
                    }
                var total = number_format_coma($("#precio_prop_"+producto+"").attr("data-precio")*$("#cantidad_prop_"+producto+"").val(),2);
                $("#factura_deta>tbody").append("<tr data-id_inv='"+$("#codigo_"+producto+"").attr("data-id_inv")+"' id='"+$("#codigo_"+producto+"").text()+"'>" +
                    "<td id='codigo'  >"+$("#codigo_"+producto+"").text()+"</td>" +
                    "<td id='nombre'>"+$("#nombre_"+producto+"").text()+"</td>" +
                    "<td id='cantidad' data-max_canti='"+$("strong#inventario_prod_"+producto+"").text()+"'>"+$("#cantidad_prop_"+producto+"").val()+"</td>" +
                    "<td id='precio_prod'>"+number_format_coma($("#precio_prop_"+producto+"").attr("data-precio"),2)+"</td>" +
                      "<td id='descuento_aplicado' data-descuento='0'>0%</td>"+
                    "<td data-descuento='0' id='total'><div class='row'><div class='col-md-9' style='padding-right: 0' id='total_val'>"+total+"</div> <div class='col-md-2' style='padding-left: 0'" +
                    "<div class='dropdown'><span class='glyphicon glyphicon-option-vertical dropdown-toggle' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'" +
                    " aria-hidden='true'></span>" +
                    "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1' style='border-color: #2d2d2d'>"+
                "<li><a id='descuento' href='"+$("#codigo_"+producto+"").text()+"'>Modificar</a></li>"+
                "<li><a id='eliminar' href='"+$("#codigo_"+producto+"").text()+"'>Eliminar</a></li>"+
                "</ul>  </div></div></div></td>" +

                    "</tr>");

                $("div#cont_prod_busc_row>table>tbody>tr#content_"+$("#codigo_"+producto+"").text()).css("background","#dff0d8");
                $("div#cont_prod_busc_row>table>tbody>tr#content_"+$("#codigo_"+producto+"").text()+" td").css("background","#dff0d8");

                recalcular();
            });



            $("#cont_prod_busc_row").on("click","#descripcion_de_producto", function (e) {
                var hijo =$(this).attr("data-element");


                    $("#descr_mostrar").empty();
                $("p#descr_mostrar").text($("td#desc_prod"+hijo+"").attr("data-descrip"));
                $("#descModal").modal();
            });



            $("#cont_desc_cliente").hide();
                $("#text_area_descri").hide();

            $("#btn_facturar").on("click",function(e) {
                 $("#opciones_caja_selec").attr("disabled","false")
                $("#tipo_pago_selec").attr("disabled","false")
                e.preventDefault();
                    var total = parseFloat($("#total_factura").text().replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", ""));

                    $("div#progreso").css("width", 0);
                    $("input#dinero_caja").val("");
                    $("#tabla_caja>tbody").empty();
                    $("input#dinero_caja").val(parseFloat($("#total_factura").text().replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "")));
                    $("input#dinero_caja").text(parseFloat($("#total_factura").text().replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "")));
                $("#dinero_caja").attr("dinero_caja",total);
                               $("#btn_agregar_caja").click();
                $("#opciones_caja_selec").attr("disabled","disabled")
                $("#tipo_pago_selec").attr("disabled","disabled")


            });

            $("#btn_agregar_caja").on("click",function(e) {
                var tipo_pago_text =$("#tipo_pago_selec option:selected").text();
                var tipo_pago = $("#tipo_pago_selec option:selected").val();
                var caja = $("#opciones_caja_selec").val();
                var caja_text = $("#opciones_caja_selec option:selected").text();
                var dinero = number_decimal($("input#dinero_caja").attr("dinero_caja"));
                var porciento =(($("input#dinero_caja").attr("dinero_caja")/ parseFloat(number_decimal($("#total_factura").text())))*100).toFixed(2);
                var total = parseFloat(number_decimal($("#total_factura").text()));

                if($("input#dinero_caja").attr("dinero_caja")<=0||$("input#dinero_caja").attr("dinero_caja")===""||total<=0){
                    $("p#infor_mostrar").empty();
                    $("p#infor_mostrar").text("Debe Haber una Cantidad de Dinero Totalizada");
                    $("#inforModal").modal().appendTo("#facturarModal");
                    return;
                }
                var dinero_caja_asignado; var total_dinero_asignado=0;
                var cantidad_cajas =$("#tabla_caja>tbody").children("tr").length;
                for(var x =1; x<= cantidad_cajas; x=x+1){
                    dinero_caja_asignado = $("#tabla_caja>tbody>tr:nth-child("+x+")>td#dinero_asig_caja").attr("data-dinero");
                    total_dinero_asignado = total_dinero_asignado +parseFloat(dinero_caja_asignado);
                }
                total_dinero_asignado=total_dinero_asignado+parseFloat($("input#dinero_caja").attr("dinero_caja"));
                if(cantidad_cajas===0){
                    total_dinero_asignado =$("input#dinero_caja").attr("dinero_caja");
                }


                if(total_dinero_asignado>total){
                    $("p#infor_mostrar").empty();
                    $("p#infor_mostrar").text("Cantidad de Dinero Excedido, Asigne la cantidad de dinero exacta faltante al total de la factura");
                    $("#inforModal").modal().appendTo("#facturarModal");
                                        return;
                }
                if($("#tabla_caja>tbody>tr#"+caja+tipo_pago+"").attr("data-caja")===caja){
                    var retotal =0;
                    retotal = parseFloat($("#tabla_caja>tbody>tr#"+caja+tipo_pago+">td#dinero_asig_caja").attr("data-dinero"))+ parseFloat( $("input#dinero_caja").attr("dinero_caja"));
                    $("#tabla_caja>tbody>tr#"+caja+tipo_pago+">td#dinero_asig_caja").attr("data-dinero", retotal);
                    $("#tabla_caja>tbody>tr#"+caja+tipo_pago+">td#dinero_asig_caja").text(number_format_coma(retotal));
                    porciento =((parseFloat($("#tabla_caja>tbody>tr#"+caja+tipo_pago+">td#dinero_asig_caja").attr("data-dinero"))/ parseFloat($("#total_factura").text().replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","")))*100).toFixed(2);
                    $("#tabla_caja>tbody>tr#"+caja+tipo_pago+">td#porciento_caja").text(porciento+"%");
                    var progreso =(total_dinero_asignado/total)*100 +"%";
                    $("div#progreso").css("width", progreso);
                    $("div#progreso").addClass("bg-primary");
                    var diferencia =total-total_dinero_asignado;
                    $("#dinero_caja").attr("dinero_caja",diferencia);
                    $("#dinero_caja").val(number_format_coma(diferencia));
                    return;
                }


                $("#tabla_caja>tbody").append("<tr  data-tipo_pago='"+tipo_pago+"' id='"+caja+tipo_pago+"' data-caja ='"+caja+"'><td data-caja ='"+caja+"'>"+caja_text+"</td><td data-tipo_pago ='"+tipo_pago+"'>"+tipo_pago_text+" </td><td id='dinero_asig_caja' data-dinero='"+dinero+"'>"+number_format_coma(dinero)+"</td><td id='porciento_caja'>"+porciento+"%</td>" +

                    "<td>" +
                    "<div class='dropdown'><span class='glyphicon glyphicon-option-vertical dropdown-toggle' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'" +
                    " aria-hidden='true'></span>" +
                    "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>"+
                    "<li><a id='eliminar_caja' href='"+caja+tipo_pago+"'>Eliminar</a></li>"+
                    "</ul>  </div>"+
                    "</td></tr>");
                var progreso =(total_dinero_asignado/total)*100 +"%";
                $("div#progreso").css("width", progreso);
                $("div#progreso").addClass("bg-primary");
                var diferencia =total-total_dinero_asignado;
                $("#dinero_caja").attr("dinero_caja",diferencia);
                $("#dinero_caja").val(number_format_coma(diferencia));


            });

            $("#guardar_factura").on("click", function (e) {
                var total = parseFloat(number_decimal($("#total_factura").text()));


                $("button#guardar_factura").attr("disabled", true);

                var tipo_operacion =$("#tipo_operacion").val();
                var comentario = $("#comentario").val();
                var id_cliente = $("#id_cliente").val();
                if(id_cliente===undefined){
                    $("p#infor_mostrar").empty();
                    $("p#infor_mostrar").text("Seleccione un cliente Para Facturar");
                    $("#inforModal").modal().appendTo("#facturarModal");
                    $("button#guardar_factura").attr("disabled", false);
                    return;
                }

                var cantida_prod =$("table#factura_deta>tbody>tr").length;
                var totales =[];  var codigos =[]; var cantidad =[];  var descuento =[]; var cod_inventario= [];
                var cajas=[]; var tipos_pagos=[]; var dinero_cajas =[];
                var valor="";var nombre;
                for (i = 1; i <= cantida_prod; i++) {
                    valor =$("table#factura_deta>tbody>tr:nth-child("+i+")>td#total>div>div#total_val").text();
                    totales.push(number_decimal(valor));
                    valor =$("table#factura_deta>tbody>tr:nth-child("+i+")>td#cantidad").text();
                    cantidad.push(number_decimal(valor));
                    valor =$("table#factura_deta>tbody>tr:nth-child("+i+")>td#descuento_aplicado").attr("data-descuento");
                    descuento.push(number_decimal(valor));
                    valor =$("table#factura_deta>tbody>tr:nth-child("+i+")").attr("data-id_inv");
                    codigos.push(valor);

                    valor =$("table#factura_deta>tbody>tr:nth-child("+i+")>td#codigo").text();
                    nombre =$("table#factura_deta>tbody>tr:nth-child("+i+")>td#nombre").text();

                    cod_inventario.push("Producto " + nombre+" Con Codigo "+ valor);
                }
                //alert(totales[1]+" "+codigos[1]+" "+cantidad[1]+" "+ descuento[1]);
                cantida_prod =$("#tabla_caja>tbody>tr").length;
                for (i = 1; i <= cantida_prod; i++) {
                    valor = $("#tabla_caja>tbody>tr:nth-child("+i+")").attr("data-caja");
                    cajas.push(valor);
                    valor = $("#tabla_caja>tbody>tr:nth-child("+i+")").attr("data-tipo_pago");
                    tipos_pagos.push(valor);
                    valor = $("#tabla_caja>tbody>tr:nth-child("+i+")>td#dinero_asig_caja").attr("data-dinero");
                    console.log(dinero_cajas);
                    dinero_cajas.push(valor);
                }
                    console.log(dinero_cajas);
                var totalizado_cajas=0;
                for(i=0;i<dinero_cajas.length; i=i+1){
                    totalizado_cajas =totalizado_cajas+parseFloat(dinero_cajas[i]);
                }

                if(totalizado_cajas<total){
                    $("p#infor_mostrar").empty();
                    $("p#infor_mostrar").text("Aun Falta Dinero Por Totalizar");
                    $("#inforModal").modal().appendTo("#facturarModal");
                    $("button#guardar_factura").attr("disabled", false);
                    return;
                }

                if(cajas.length===0){
                    $("p#infor_mostrar").empty();
                    $("p#infor_mostrar").text("Seleccione Asigne el Dinero a una Caja");
                    $("#inforModal").modal().appendTo("#facturarModal");
                    $("button#guardar_factura").attr("disabled", false);
                    return;
                }
                if(codigos.length===0){
                    $("p#infor_mostrar").empty();
                    $("p#infor_mostrar").text("Agregue Algun Producto para facturar");
                    $("#inforModal").modal().appendTo("#facturarModal");
                    $("button#guardar_factura").attr("disabled", false);
                    return;
                }

                $.ajax({
                    type:"Put",
                     dataType:"json",
                    data:{id_cliente: id_cliente,tipo_operacion_id:tipo_operacion, inventarios:codigos,
                    cantidades:cantidad, dineros:totales, descuentos:descuento, observacion:comentario,
                    cajas:cajas,dinero_cajas: dinero_cajas,tipo_pagos_caja: tipos_pagos,
                        cod_inventarios:cod_inventario, total:total},
                    url:"{{Route("Facturacion.update",["Facturacion"=>$operacion->consecutivo])}}",
                    success: function(resp){
                          if(resp["estado"]=="Error"){
                        $("p#infor_mostrar").empty();
                        $("p#infor_mostrar").text(resp["mensaje"]);
                        $("#inforModal").modal().appendTo("#facturarModal");
                              $("button#guardar_factura").attr("disabled", false);
                           }if(resp["estado"]=="OK"){
                            $("p#infor_mostrar").empty();
                            $("p#infor_mostrar").text(resp["mensaje"]);
                            $("div#estado_operacion").empty();
                            $("p#infor_mostrar").append("<div style='height:50px;  text-align:center '>" +
                                "<img src='{{ URL::asset('img/ok.png')}}' width='50px' height='50px'> "+
                                "</div>");
                            $("#inforModal").modal().appendTo("#facturarModal");
                            window.setTimeout(function(){
                               location.href="{{Route('Facturacion.show',["id"=>5])}}";
                            }, 1500);
                        }
                    }


            });
            });

            $("#dinero_caja").keyup(function(e) {

                var valor =$("#dinero_caja").val();

                $("#dinero_caja").attr("dinero_caja",number_decimal(valor));
                $("#dinero_caja").val(number_format_coma(valor));
            });


            $("ul#pestanas_facturacion  ").on("click", "span",function (e) {

                var id_li = $(this).attr("data-id");
                var id_div = $("li#"+id_li).attr("data-div");
                var no_div = $("li#"+id_li).attr("data-no_div");

                $("#"+id_div).empty();

                $("#"+no_div).slideDown(500);
                var li_activo =$("#"+id_div).attr("data-no_li");
                alert(li_activo);
                $("li#"+id_li).remove();
                $("li#"+li_activo).css("font-weight","bolder");

                e.stopPropagation();

            });
            $("ul#pestanas_facturacion ").on("click", "li",function (e) {
                $("ul#pestanas_facturacion li ").css("font-weight","normal");
                var id_div = $(this).attr("data-div");
                var no_div = $(this).attr("data-no_div");
                $(this).css("font-weight","bolder");
                $("#"+id_div).slideDown(500);
                $("#"+no_div).slideUp(500);

            });




            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

            $("#cedula").keypress(function(e) {
                var cedula = $("#cedula").val();
                if(e.which == 13) {

                    $.ajax({
                        type:"Get",
                        dataType:"json",
                        url:"/Clientes"+"/"+ cedula+"/"+"{{ Auth::user()->id_establecimiento}}",
                        success: function(resp){
                            console.log(resp.length);
                            if(resp.length===0){
                                $("ul#pestanas_facturacion li ").css("font-weight","normal");
                                if($("li#pestana_register").length>0){
                                    $("li#pestana_register").css("font-weight","bolder");
                                    $("#contenido_facturacion").slideUp(500);
                                    $("#contenido_registrar_cliente").slideDown(500);
                                    $("#cont_desc_cliente").slideUp(500);
                                    $("#text_area_descri").slideUp(500);
                                    return
                                }
                                $("#pestanas_facturacion").append("<li id='pestana_register' style='font-weight: bolder' data-div='contenido_registrar_cliente' data-no_div='contenido_facturacion' class='active'><a  >Creacion Cliente <span data-id='pestana_register' class='glyphicon glyphicon-remove' aria-hidden='true'></span> </a> </li>");
                                $("#contenido_registrar_cliente").append("<iframe class='col-md-12' height='600px' src='{{Route("Cliente2.index2")}}'></iframe>");
                                $("#contenido_facturacion").slideUp(500);
                                $("#contenido_registrar_cliente").slideDown(500);
                                $("#cont_desc_cliente").slideUp(500);
                                $("#text_area_descri").slideUp(500);

                                return;
                            }
                            var datos_cliente = resp[0];
                           // console.log(resp);
                           // console.log(datos_cliente["firts_name"]);
                            $("#descripcion_cliente").empty();
                            $("#descripcion_cliente").css('border',"none");
                            $("#descripcion_cliente").css('font-weight',"bolder");
                            $("#cont_desc_cliente").show();
                            $("#cont_desc_cliente").slideUp(300);
                           var agregar = "<table> <tr class='row'><td class='col-md-3'> Nombre: </td><td    class='col-md-9'>"+datos_cliente["firts_name"]+" " + datos_cliente["last_name"]+"</td></tr>";
                            agregar += "<tr class='row'><td class='col-md-3'> Celular: </td><td   class='col-md-9'>"+datos_cliente["celular_1"] + "   "+ datos_cliente["celular_2"]+"</td></tr>";
                            agregar +="<tr class='row'><td class='col-md-3'>Direccion: </td><td  class='col-md-9'>"+datos_cliente["direccion"] + " - "+ datos_cliente["municipio"]+"</td></tr>";
                            agregar +="</table>";
                            agregar +="<input type='hidden' name='id_cliente' id='id_cliente' value='"+datos_cliente["id"] +"'>";
                            $("#descripcion_cliente").append(agregar);
                            $("#cont_desc_cliente").slideDown(500);
                            $("#text_area_descri").slideDown(500);


                        }});

                }
            });


            $("#btn_agregar_prod").on("click", function (e) {
                $("#cont_prod_busc_row table").empty();
                $("#opciones_busquedad").addClass("hide");
                $("#producto").val("");

            });

            $('#myModal').on('shown.bs.modal', function () {

                $("#producto").focus();
            });







            $("input#producto").on("keyup", function (e) {
                var nombre  = $("input#producto").val();
                var hijos =1;
                if(nombre===""){
                    $("#cont_prod_busc_row >table").empty();
                    return;
                }
                $.ajax({
                    type:"Get",
                    dataType:"json",
                    url:"/Productos/"+nombre+"/ajax_prod",
                    success: function(resp){
                         lista_prod=[];
                         lista_prod_id=[];
                         console.log(resp);
                        var m=resp.length;
                        console.log(m);

                            $("#cont_prod_busc_row >table").empty();

                        $("#cont_prod_busc_row table").append(" <thead><td style='text-align: center'><strong>Codigo</strong></td>" +
                            "<td style='text-align: center; width: 20%'><strong>Nombre</strong></td><td style='text-align: center; width: 12%'><strong>Ubicacion</strong></td>"+
                            "<td  style='text-align: center; width: 14%'><strong>Disponible</strong></td>" +
                            " <td style='text-align: center; width: 14%'><strong >Precio</strong></td>" +
                            "<td style='text-align: center; width: 12%'><strong>Facturar</strong></td>"+
                            "<td  style='text-align: center; width: 18%'><strong>Agregar</strong></td></thead>");

                        for(var t=0; t<m; t=t+1) {
                            var datos = resp[t];

                            // console.log(datos["nombre"]);
                            lista_prod.push(datos["nombre"]+"-"+datos["codigo"]);
                            lista_prod_id[datos["nombre"]+"-"+datos["codigo"]]=datos["id"];

                                var detalle_prod = resp[t];
                                var inventario= detalle_prod["inventario"];
                                var bodega_prod = inventario["bodega"];
                                console.log(inventario["codigo"]);
                                console.log(inventario["cantidad"]);
                                console.log(detalle_prod["precio_venta"]);
                                var fondo_color="";
                                var fondo="";
                                var lenght_inventario = inventario.length;
                                console.log(lenght_inventario);
                                if(lenght_inventario>1){
                                    var w;
                                    var cantidad ="";

                                    for( w=0; w<lenght_inventario; w=w+1) {
                                            var inventario_2 =inventario[w];
                                            console.log(inventario_2);
                                             bodega_prod = inventario_2["bodega"];

                                        fondo="";
                                        fondo_color="";
                                        cantidad="";
                                            if($("table#factura_deta>tbody>tr#"+inventario_2["codigo"]).length>0){
                                                fondo=" bg-success";
                                                fondo_color="#dff0d8";
                                            cantidad=$("table#factura_deta>tbody>tr#"+inventario_2["codigo"]+">td#cantidad").text();
                                            }

                                                    $(" #cont_prod_busc_row table").append("<tr id='content_"+inventario_2["codigo"]+"'  class='"+fondo+"'><div   class='col-md-12 ' >"+
                                                        //"<img class='col-md-12' height='150px' src='img/bombillo.jpg'>"+
                                                        //"<div class='col-m-4' style='text-align: center'>"+
                                                        "<td style='background-color: "+ fondo_color+"'><div class='col-md-12'><h6><strong id='codigo_"+hijos+"' data-id_inv='"+inventario_2["id"]+"'>"+inventario_2["codigo"]+"</strong></h6></div></td>"+
                                                        "<td style='background-color: "+ fondo_color+"' id='desc_prod"+hijos+"' class='desc_ocul ' data-element ='"+hijos+"' data-descrip='"+detalle_prod["descripcion"]+"'><div class='col-md-12' ><h5 id='nombre_"+hijos+"'>"+detalle_prod["nombre"]+"</h5></div></td>"+


                                                        "</div>"+
                                                        "<td style='background-color: "+ fondo_color+"'><div class='col-md-12'>"+
                                                        //"<p class='col-md-6'  ><strong>Ubicacion</strong></p>"+
                                                        //"<div class='col-md-6'>"+
                                                        "<p style='margin-top: 5px; font-size: 14px; text-align: center'>"+bodega_prod["nombre"]+"</p>"+
                                                        //"</div>"+

                                                        " </div></td>"+


                                                        "<div class='col-md-3'  >"+
                                                        "<td style='background-color: "+ fondo_color+"'><p class='col-md-12' style='padding: 6px 12px; text-align: center' ><strong id='inventario_prod_"+hijos+"' >"+inventario_2["cantidad"]+"</strong></p></td>"+
                                                        "<td style='background-color: "+ fondo_color+"'><p class='col-md-12'  style='margin-top: 5px; font-size: 14px; text-align: center'><strong data-precio="+detalle_prod["precio_venta"]+" id='precio_prop_"+hijos+"'>$ "+number_format_coma(detalle_prod["precio_venta"],2)+"</strong> </p></td>"+
                                                        "<td style='background-color: "+ fondo_color+"'><div class='col-md-12' style='margin-top: 4px'>"+
                                                        "<input class='form-control' value='"+cantidad+"' id='cantidad_prop_"+hijos+"'  type='number' name='cantidad_prop_"+hijos+"'>"+
                                                        "</div></td>"+


                                                        "</div>"+
                                                        "<div class='col-md-4'> "+

                                                            "<td style='background-color: "+ fondo_color+"'><div class='col-md-12' style='margin-top: 4px'>"+

                                                        "<button type='button'  data-element ='"+hijos+"' " +
                                                        "  class='btn btn-primary col-md-9' id='btn_agregar_prod_conse'>"+
                                                        "Agregar"+
                                                        "</button>" +
                                                        "<div class='col-md-3' >" +
                                                        "<span data-element='"+hijos+"' id='descripcion_de_producto' class='glyphicon glyphicon-option-vertical dropdown-toggle' " +
                                                        "</div>" +
                                                        "</div></td>"+

                                                        "</div></div></tr>");
                                            hijos = hijos +1;
                                        fondo="";
                                        cantidad="";
                                    }
                                    fondo="";
                                    fondo_color="";
                                    cantidad="";

                                }else if(lenght_inventario===1){
                                    inventario= detalle_prod["inventario"];
                                    inventario=inventario[0];
                                    bodega_prod = inventario["bodega"];

                                    if($("table#factura_deta>tbody>tr#"+inventario["codigo"]).length>0){
                                        fondo=" bg-success";
                                        fondo_color="#dff0d8";
                                        cantidad=$("table#factura_deta>tbody>tr#"+inventario["codigo"]+">td#cantidad").text();
                                    }
                                    $(" #cont_prod_busc_row table").append("<tr id='content_"+inventario["codigo"]+"'    data-id_inv='"+inventario["id"]+"' class='"+fondo+"'><div   class='col-md-12 ' >"+
                                        //"<img class='col-md-12' height='150px' src='img/bombillo.jpg'>"+
                                        //"<div class='col-m-4' style='text-align: center'>"+
                                        "<td style='background-color: "+ fondo_color+"'><div class='col-md-12'><h6><strong id='codigo_"+hijos+"' data-id_inv='"+inventario["id"]+"'>"+inventario["codigo"]+"</strong></h6></div></td>"+
                                        "<td style='background-color: "+ fondo_color+"' id='desc_prod"+hijos+"' class='desc_ocul ' data-element ='"+hijos+"' data-descrip='"+detalle_prod["descripcion"]+"'><div class='col-md-12' ><h5 id='nombre_"+hijos+"'>"+detalle_prod["nombre"]+"</h5></div></td>"+


                                        "</div>"+
                                        "<td style='background-color: "+ fondo_color+"'><div class='col-md-12'>"+
                                        //"<p class='col-md-6'  ><strong>Ubicacion</strong></p>"+
                                        //"<div class='col-md-6'>"+
                                        "<p style='margin-top: 5px; font-size: 14px; text-align: center'>"+bodega_prod["nombre"]+"</p>"+
                                        //"</div>"+

                                        " </div></td>"+


                                        "<div class='col-md-3'  >"+
                                        "<td style='background-color: "+ fondo_color+"'><p class='col-md-12' style='padding: 6px 12px; text-align: center' ><strong id='inventario_prod_"+hijos+"' >"+inventario["cantidad"]+"</strong></p></td>"+
                                        "<td style='background-color: "+ fondo_color+"'><p class='col-md-12'  style='margin-top: 5px; font-size: 14px; text-align: center'><strong data-precio="+detalle_prod["precio_venta"]+" id='precio_prop_"+hijos+"'>$ "+number_format_coma(detalle_prod["precio_venta"],2)+"</strong> </p></td>"+
                                        "<td style='background-color: "+ fondo_color+"'><div class='col-md-12' style='margin-top: 4px'>"+
                                        "<input class='form-control' value='"+cantidad+"' id='cantidad_prop_"+hijos+"'  type='number' name='cantidad_prop_"+hijos+"'>"+
                                        "</div></td>"+


                                        "</div>"+
                                        "<div class='col-md-4'> "+

                                        "<td style='background-color: "+ fondo_color+"'><div class='col-md-12' style='margin-top: 4px'>"+

                                        "<button type='button'  data-element ='"+hijos+"' " +
                                        "  class='btn btn-primary col-md-9' id='btn_agregar_prod_conse'>"+
                                        "Agregar"+
                                        "</button>" +
                                        "<div class='col-md-3' >" +
                                        "<span data-element='"+hijos+"' id='descripcion_de_producto' class='glyphicon glyphicon-option-vertical dropdown-toggle' " +
                                        "</div>" +
                                        "</div></td>"+

                                        "</div></div></tr>");
                                    hijos = hijos +1;
                                    fondo="";
                                    cantidad="";

                                }



                        }

                    }});

            });












        });

        function number_format(amount, decimals) {

            amount += ''; // por si pasan un numero en vez de un string
            amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

            decimals = decimals || 0; // por si la variable no fue fue pasada

            // si no es un numero o es igual a cero retorno el mismo cero
            if (isNaN(amount) || amount === 0)
                return parseFloat(0).toFixed(decimals);

            // si es mayor o menor que cero retorno el valor formateado como numero
            amount = '' + amount.toFixed(decimals);

            var amount_parts = amount.split(','),
                regexp = /(\d+)(\d{3})/;

            while (regexp.test(amount_parts[0]))
                amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2');

            return amount_parts.join('.');
        }
        function recalcular(){
            var cantida_prod =$("table#factura_deta>tbody>tr").length;

            var base=0;
            var impuesto = (19/100);
            var total_producto=0;
            for (i = 1; i <= cantida_prod; i++) {
                var valor =$("table#factura_deta>tbody>tr:nth-child("+i+")>td#total>div>div#total_val").text();

                total_producto = total_producto+ parseFloat(valor.replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",",""));

            }
           impuesto= total_producto*(19/100);
            base = total_producto-impuesto;
           $("#base_factura").text(number_format_coma(base.toFixed(2),2));
           $("#impuesto_factura").text(number_format_coma(impuesto.toFixed(2),2));
            $("#total_factura").text(number_format_coma(total_producto.toFixed(2),2));
            }

        function number_format_coma(amount, decimals) {

            amount += ''; // por si pasan un numero en vez de un string
            amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

            decimals = decimals || 0; // por si la variable no fue fue pasada

            // si no es un numero o es igual a cero retorno el mismo cero
            if (isNaN(amount) || amount === 0)
                return parseFloat(0).toFixed(decimals);

            // si es mayor o menor que cero retorno el valor formateado como numero
            amount = '' + amount.toFixed(decimals);

            var amount_parts = amount.split('.'),
                regexp = /(\d+)(\d{3})/;

            while (regexp.test(amount_parts[0]))
                amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

            return amount_parts.join('.');
        }
        function progreso(eliminado){




            var dinero = number_decimal($("input#dinero_caja").val());

            var total = parseFloat($("#total_factura").text().replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",",""));


            var dinero_caja_asignado; var total_dinero_asignado=0;
            var cantidad_cajas =$("#tabla_caja>tbody").children("tr").length;

            for(var x =1; x<= cantidad_cajas; x=x+1){

                if($("#tabla_caja>tbody>tr:nth-child("+x+")").attr("id")===eliminado){
                    break;

                }
                dinero_caja_asignado = $("#tabla_caja>tbody>tr:nth-child("+x+")>td#dinero_asig_caja").attr("data-dinero");
                total_dinero_asignado = total_dinero_asignado +parseFloat(dinero_caja_asignado);
            }
            //total_dinero_asignado=total_dinero_asignado+parseFloat($("input#dinero_caja").val());
            if(cantidad_cajas===0){
                $("div#progreso").css("width", 0);
                $("div#progreso").removeClass("bg-primary");
                return;
            }
            if(total_dinero_asignado>total){
                return;
            }



            var progreso =(total_dinero_asignado/total)*100 +"%";

            $("div#progreso").css("width", progreso);
            $("div#progreso").addClass("bg-primary");
            var diferencia =total-total_dinero_asignado;
            $("#dinero_caja").attr("dinero_caja",diferencia);
            $("#dinero_caja").val(number_format_coma(diferencia));

        }
            function number_decimal(numero){
              var retorno= numero.replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","");
              return retorno;

            }
    </script>

    @endsection