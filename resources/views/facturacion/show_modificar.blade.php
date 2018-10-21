
@extends('layouts.app')

@section('content')
@include('layouts.menu.ventasc.admin')
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" id="tit_register">
                                        <div style="display: inline-block;">
                    <a class="btn btn-info" href="{{route('Facturacion.index')}}"><i class="glyphicon glyphicon-plus"></i></a>
                    </div>
                    <div style="font-size: 20px; display: inline-block; height: 100%; vertical-align: middle;">{{$title}}</div>
                </div>
                <div class="panel-body">
                    <table class="table" style="background-color: #2d2d2d">
                        <thead  style="background-color: #2d2d2d">
                        <tr  style="background-color: #2d2d2d">
                            <th  style="background-color: #2d2d2d">Codigo</th>
                            <th  style="background-color: #2d2d2d">Nombre</th>
                            <th style="background-color: #2d2d2d">Fecha</th>
                            <th style="background-color: #2d2d2d">Total</th>
                            <th style="background-color: #2d2d2d">Editar</th>
                            <th style="background-color: #2d2d2d">Eliminar</th>
                            <th style="background-color: #2d2d2d">Imprimir</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($operaciones as $operacione)
                            <tr>
                                <td>{{$operacione->consecutivo}}</td>
                                <td>{{$operacione->cliente->firts_name ." ". $operacione->cliente->last_name}}</td>
                                <td>{{$operacione->created_at}}</td>
                                <td>$ {{number_format($operacione->total,2)}}</td>
                                <td><a href="{{Route("Facturacion.edit",["id"=>$operacione->id])}}">Editar</a></td>
                                <td><a  href="">Eliminar</a></td>
                                <td><a  href="">Imprimir</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
          </div>
            </div>
        </div>
    </div>



@endsection