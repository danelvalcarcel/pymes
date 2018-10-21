
@extends('layouts.app')

@section('content')
@include("layouts.menu.nomina.admin")
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
                    <a class="btn btn-info" href="{{route('formulario_cargo',['id'=>0, 'ruta'=>'crear'])}}"><i class="glyphicon glyphicon-plus"></i></a>
                    </div>
                    <div style="font-size: 20px; display: inline-block; height: 100%; vertical-align: middle;">{{$title}}</div>
                </div>

                <style type="text/css" media="screen">
                .btn{
                    padding: 3px;
                }    
                </style>
                <div class="panel-body">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-sm-2" style="text-align: center;" ><label>Nombre</label></div>
                            <div class="col-sm-4"><input  class="form-control" type="text" name="busquedad" value="" placeholder="Ingrese el nombe"></div>
                            <div class="col-sm-4" style="padding: 0 20px 0 20px"><input class="btn btn-success col-sm-6" type="submit" name="enviar" value="Buscar"></div>
                        </div>
                    </form>
                    <table class="table " style="margin-top: 30px">
                        <thead>
                            <tr>
                            <td>#</td>
                            <td>Nombre</td>
                            <td style="text-align: center;"><i class="glyphicon glyphicon-eye-open"></i></td>
                            <td style="text-align: center;"><i class="glyphicon glyphicon-edit"></i></td>
                            <td style="text-align: center;"><i class="glyphicon glyphicon-trash"></i></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cargos as $cargo)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$cargo->nombre}}</td>
                            <td style="text-align: center;"><a title="Ver Elemento" href="{{route('formulario_cargo',['id'=>$cargo->idcargo, 'ruta'=>'ver'])}}" class="btn btn-success"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                            <td style="text-align: center;"><a title="Editar Elemento" href="{{route('formulario_cargo',['id'=>$cargo->idcargo, 'ruta'=>'actualizar'])}}" class="btn btn-info"><i class="glyphicon glyphicon-edit"></i></a></td>
                            <td style="text-align: center;">
                                <form action="{{route('delete_cargo',['id'=>$cargo->idcargo])}}" method="POST">
                                   {{-- method_field('DELETE') --}} {{ csrf_field() }}
                                    <input title="Eliminar Elemento" onclick="return confirm('Desea Eliminar el Registro?')" type="submit"  class="glyphicon glyphicon-trash btn btn-danger" name="Eliminar" value="Eliminar"></form>
                                </td>
                            </tr>
                        @endforeach
                           
                        </tbody>
                        <tfoot>
                         
                        </tfoot>

               
                </table>
                {{ $cargos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
