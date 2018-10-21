
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
                            <div class="col-sm-4"><input  class="form-control" type="date" name="busquedad" value="" placeholder="Ingrese el nombre"></div>
                            <div class="col-sm-4" style="padding: 0 20px 0 20px"><input class="btn btn-success col-sm-6" type="submit" name="enviar" value="Buscar"></div>
                        </div>
                    </form>
                    <table class="table " style="margin-top: 30px">
                        <thead>
                            <tr>
                            <td>#</td>
                            <td>Nombre</td>
                            <td>Desde</td>
                            <td style="text-align: center;"><i class="glyphicon glyphicon-eye-open"></i></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($EmpleadoVacaciones as $EmpleadoVacacione)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$EmpleadoVacacione->empleado->nombres}}  {{$EmpleadoVacacione->empleado->apellidos}}</td>

                             <td>{{$EmpleadoVacacione->fecha_desde}}</td>
                            <td style="text-align: center;"><a title="Ver Elemento" href="{{route('formulario_EmpleadoVacacione',['id'=>$EmpleadoVacacione->id, 'ruta'=>'ver'])}}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                            </tr>
                        @endforeach
                           
                        </tbody>
                        <tfoot>
                         
                        </tfoot>

               
                </table>
                {{ $EmpleadoVacaciones->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
