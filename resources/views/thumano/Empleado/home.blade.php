
@extends('layouts.app')

@section('content')
@include("layouts.menu.thumano.admin")
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">
                 @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="panel-heading">
                    <div style="display: inline-block;">
                    <a class="btn btn-info" href="{{route('formulario_Empleado',['id'=>0, 'ruta'=>'crear'])}}"><i class="glyphicon glyphicon-plus"></i></a>
                    </div>
                    <div style="font-size: 20px; display: inline-block; height: 100%; vertical-align: middle;">{{$title}}</div>
                </div>

                <style type="text/css" media="screen">
                .btn{
                    padding: 3px;
                }    
                </style>
                <div class="panel-body">
                    <form id="form_busquedad" action="" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-2" style="text-align: center;" >
                                <select required class="form-control" name="nombre_campo" id="nombre_campo" name="nombre_campo">
                                    <option value="documento">Documento</option>
                                    <option value="nombres">Nombre</option>
                                    <option value="idcargo">Cargo</option>
                                    <option value="idcentro">Centro</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <input  class="form-control" type="text" name="busquedad" id="busquedad" value="" placeholder="Ingrese el nombre">
                                <select class="form-control" style="display: none;" name="cargo" id="cargo">
                                     @foreach($cargos as $data)
                                    <option value="{{$data->idcargo}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>

                                <select class="form-control" style="display: none;" name="centro" id="centro">
                                    @foreach($Centros_trabajos as $data)
                                    <option value="{{$data->idcentro}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6" style="padding: 0 20px 0 20px">
                                <input class="btn btn-success col-sm-3" type="submit" name="enviar" value="Buscar">
                                <a class="btn btn-info col-sm-3" href="{{url('All_Empleado')}}" value="Borrar filtros">Borrar Filtro</a>
                                <input type="hidden" name="reporte" id="reporte" value="">
                                <input id="pdf_export" class="btn btn-danger col-sm-3" type="submit" name="PDF" value="PDF">
                                <input id="excel_export" class="btn btn-success col-sm-3" type="submit" name="EXCEL" value="EXCEL">
                            </div>
                        </div>
                    </form>
                    <table class="table " style="margin-top: 30px">
                        <thead>
                            <tr>
                            <td>#</td>
                            <td>Doc</td>
                            <td>Fecha Ingreso</td>
                            <td>Nombre</td>
                            <td>Cargo</td>
                            <td>Centro</td>
                            <td>Sueldo</td>
                            <td style="text-align: center;"><i class="glyphicon glyphicon-cloud-download"></i></td>
                            <td style="text-align: center;"><i class="glyphicon glyphicon-cloud-download"></i></td>
                            <td style="text-align: center;"><i class="glyphicon glyphicon-eye-open"></i></td>
                            <td style="text-align: center;"><i class="glyphicon glyphicon-edit"></i></td>
                            <td style="text-align: center;"><i class="glyphicon glyphicon-trash"></i></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empleados as $empleado)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$empleado->documento}}</td>
                            <td>{{$empleado->fecha_ingreso}}</td>
                            
                            <td>{{$empleado->nombres}}</td>
                            <td>{{$empleado->Cargo->nombre}}</td>
                            <td>{{$empleado->Centro_trabajo->nombre}}</td>
                            <td>{{number_format($empleado->sueldo, 0, ',', '.')}}</td>
                            <td style="text-align: center;"><a target="_blank" title="Descargar Certificado" href="{{route('Certificado_Empleado',['id'=>$empleado->idempleado])}}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-cloud-download"></i></a></td>
                            <td style="text-align: center;"><a target="_blank" title="Descargar Contrato" href="{{route('Certificado_Empleado',['id'=>$empleado->idempleado])}}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-cloud-download"></i></a></td>
                            <td style="text-align: center;"><a title="Ver Empleado" href="{{route('formulario_Empleado',['id'=>$empleado->idempleado, 'ruta'=>'ver'])}}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                            <td style="text-align: center;"><a title="Editar Empleado" href="{{route('formulario_Empleado',['id'=>$empleado->idempleado, 'ruta'=>'actualizar'])}}" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i></a></td>
                            <td style="text-align: center;">
                                <form action="{{route('delete_Empleado',['id'=>$empleado->idempleado])}}" method="POST">
                                    {{ csrf_field() }}
                                    <input title="Eliminar Empleado" onclick="return confirm('Desea Eliminar el Empleado?')" type="submit"  class="glyphicon glyphicon-trash btn btn-xs btn-danger" name="Eliminar" value="Eliminar">
                                </form>
                                
                                </td>
                            </tr>
                        @endforeach
                           
                        </tbody>
                        <tfoot>
                         
                        </tfoot>

               
                </table>
                {{ $empleados->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
                                    
@endsection
@section('script')
<script >
    $(document).ready(function($) {
    $("#nombre_campo").on("change",function(){
        if($(this).val()==="idcargo"){
            $("#cargo").show();
            $("#centro").hide();
            $("#busquedad").hide();
        }else if($(this).val()==="idcentro"){
            $("#centro").show();
            $("#cargo").hide();
            $("#busquedad").hide();
        }else{
             $("#busquedad").show();
            $("#cargo").hide();
            $("#centro").hide();
        }
    })
    var data_campo ="{{$data_filtro1}}";
    if(data_campo==="idcargo"){
            $("#cargo").show();
            $("#cargo").val("{{$data_filtro2}}")
            $("#centro").hide();
            $("#busquedad").hide();
        }else if(data_campo==="idcentro"){
            $("#centro").show();
             $("#centro").val("{{$data_filtro2}}")
            $("#cargo").hide();
            $("#busquedad").hide();
        }
        else if(data_campo==="documento"){
             $("#busquedad").show();
            $("#cargo").hide();
            $("#centro").hide();
            $("#busquedad").val("{{$data_filtro2}}")
        }else{
             $("#busquedad").show();
            $("#cargo").hide();
            $("#centro").hide();
            $("#busquedad").val("{{$data_filtro2}}")
        }
    $("#nombre_campo").val("{{$data_filtro1}}");


    $("input#pdf_export").on("click", function(e){
            e.preventDefault();
            e.stopPropagation();
            if($("#nombre_campo").val()=="nombres" || $("#nombre_campo").val()=="documento" ){

                 if($("#busquedad").val()===""){
                         alert("Ingrese un dato de busquedad")
                return;
            }
            }
           $("#reporte").val("PDF");
   $('#form_busquedad').attr('action', "{{route('Report_Empleado')}}");
   $('#form_busquedad').submit();
   $('#form_busquedad').attr('action', "");

    })


    $("input#excel_export").on("click", function(e){
            e.preventDefault();
            e.stopPropagation();

            if($("#nombre_campo").val()=="nombres" || $("#nombre_campo").val()=="documento" ){

                 if($("#busquedad").val()===""){
                         alert("Ingrese un dato de busquedad")
                return;
            }
            }
            $("#reporte").val("EXCEL");
   $('#form_busquedad').attr('action', "{{route('Report_Empleado')}}");
   $('#form_busquedad').submit();
    $('#form_busquedad').attr('action', "");

    })

    });
    </script>
   @endsection