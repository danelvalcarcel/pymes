
@extends('layouts.app')

@section('content')
@include($menu)
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
                        @if($sede)
                        <a class="btn btn-info" href="{{route('formulario_Vacacione',['id'=>0, 'ruta'=>'crear','sede'=>'Sede'])}}"><i class="glyphicon glyphicon-plus"></i></a>
                        @else
                        <a class="btn btn-info" href="{{route('formulario_Vacacione',['id'=>0, 'ruta'=>'crear'])}}"><i class="glyphicon glyphicon-plus"></i></a>
                        @endif
                    
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
                                 @if($sede)
                                    <input type="hidden" name="sede_expor" value="{{$sede}}" >
                                    @else
                                    @endif

                                <select class="form-control" style="display: none;" name="centro" id="centro">
                                    @foreach($Centros_trabajos as $data)
                                    <option value="{{$data->idcentro}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6" style="padding: 0 20px 0 20px">
                                <input class="btn btn-success col-sm-3" type="submit" name="enviar" value="Buscar">
                                <div style="display: none">
                                    @if($sede)
                                    <a class="btn btn-info col-sm-3" href="{{url('All_Vacacione',['sede'=>'Sede'])}}" value="Borrar filtros">Borrar Filtro</a>
                                    @else
                                    <a class="btn btn-info col-sm-3" href="{{url('All_Vacacione')}}" value="Borrar filtros">Borrar Filtro</a>
                                    @endif
                                
                                <input type="hidden" name="reporte" id="reporte" value="">
                                <input id="pdf_export" class="btn btn-danger col-sm-3" type="submit" name="PDF" value="PDF">
                                <input id="excel_export" class="btn btn-success col-sm-3" type="submit" name="EXCEL" value="EXCEL">
                                </div>
                            </div>
                        </div>
                    </form>
                    <table class="table " style="margin-top: 30px">
                        <thead>
                            <tr>
                            <td>#</td>
                            <td>Nombre</td>
                            <td>Desde</td>
                            <td>Hasta</td>
                            <td>Estado</td>
                            <td style="text-align: center;"><i class="glyphicon glyphicon-eye-open"></i></td>
                            <td style="text-align: center;"><i class="glyphicon glyphicon-edit"></i></td>
                            <td style="text-align: center;"><i class="glyphicon glyphicon-trash"></i></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Vacaciones as $Vacacione)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$Vacacione->empleado->nombres}}  {{$Vacacione->empleado->apellidos}}</td>

                             <td>{{$Vacacione->fecha_desde}}</td>

                              <td>{{$Vacacione->fecha_hasta}}</td>
                              <td>{{$Vacacione->estado}}</td>
                            <td style="text-align: center;"><a title="Ver Elemento" href="{{route('formulario_Vacacione',['id'=>$Vacacione->id, 'ruta'=>'ver'])}}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                            <td style="text-align: center;"><a title="Editar Elemento" href="{{route('formulario_Vacacione',['id'=>$Vacacione->id, 'ruta'=>'actualizar'])}}" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i></a></td>
                            <td style="text-align: center;">
                                <form action="{{route('delete_Vacacione',['id'=>$Vacacione->id])}}" method="POST">
                                   {{-- method_field('DELETE') --}} {{ csrf_field() }}
                                    <input title="Eliminar Elemento" onclick="return confirm('Desea Eliminar el Registro?')" type="submit"  class="glyphicon glyphicon-trash btn btn-xs btn-danger" name="Eliminar" value="Eliminar"></form>
                                </td>
                            </tr>
                        @endforeach
                           
                        </tbody>
                        <tfoot>
                         
                        </tfoot>

               
                </table>
                {{ $Vacaciones->links() }}
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
   $('#form_busquedad').attr('action', "{{route('Report_Incapacidade')}}");
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
   $('#form_busquedad').attr('action', "{{route('Report_Incapacidade')}}");
   $('#form_busquedad').submit();
    $('#form_busquedad').attr('action', "");

    })

    });
    </script>
   @endsection