
@extends('layouts.app')

@section('content')
@include("layouts.menu.administracion.admin")
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">
                                   @if($message=Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {{Session::get('message')}}
                        </div>
                    @endif

                    @if($message=Session::has('message-error'))
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {{Session::get('message-error')}}
                        </div>
                    @endif
                        @if (!$errors->isEmpty())
                        <div class="form-group has-error alert alert-warning">
                        <span class="help-block">
                            @foreach($errors->all() as $error)
                                <p><strong>{{ $error }}</strong></p>
                            @endforeach
                        </span>
                        </div>
                    @endif
                <div class="panel-heading">
                    <div style="display: inline-block;">
                    <a class="btn btn-info" href="{{route('formulario_Cliente',['id'=>0, 'ruta'=>'crear'])}}"><i class="glyphicon glyphicon-plus"></i></a>
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
                            <div class="col-sm-4"><input  class="form-control" type="text" name="busquedad" value="" placeholder="Ingrese el nombre"></div>
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
                            @foreach ($Clientes as $Cliente)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$Cliente->firts_name}}</td>

                            <td style="text-align: center;"><a title="Ver Elemento" href="{{route('formulario_Cliente',['id'=>$Cliente->id, 'ruta'=>'ver'])}}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                            <td style="text-align: center;"><a title="Editar Elemento" href="{{route('formulario_Cliente',['id'=>$Cliente->id, 'ruta'=>'actualizar'])}}" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"></i></a></td>
                            <td style="text-align: center;">
                                <form action="{{route('delete_Cliente',['id'=>$Cliente->id])}}" method="POST">
                                   {{-- method_field('DELETE') --}} {{ csrf_field() }}
                                    <input title="Eliminar Elemento" onclick="return confirm('Desea Eliminar el Registro?')" type="submit"  class="glyphicon glyphicon-trash btn btn-xs btn-danger" name="Eliminar" value="Eliminar"></form>
                                </td>
                            </tr>
                        @endforeach
                           
                        </tbody>
                        <tfoot>
                         
                        </tfoot>

               
                </table>
                {{ $Clientes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
