
@extends('layouts.app')

@section('content')
@include('layouts.menu.administracion.admin')
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">

<div >
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" id="tit_register">Registro de Clientes</div>
                <div class="panel-body">
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
                      <form id="form_sueldo" class="form-horizontal" enctype="multipart/form-data" action="{{ route($ruta)}}" method="post">
                 {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('firts_name') ? ' has-error' : '' }}">
                                    <label id="milabel" for="firts_name" class="col-md-3 control-label">Nombres</label>

                                    <div class="col-md-9">
                                        <input id="firts_name" type="text" class="form-control" name="firts_name" value="{{ $elemento->firts_name }}" required autofocus>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="last_name" class="col-md-3 control-label">Apellidos</label>

                                    <div class="col-md-9">
                                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $elemento->last_name }}" required>

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="email" class="col-md-3 control-label">E-Mail</label>

                                    <div class="col-md-9">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $elemento->email }}" required>

                                    </div>
                                </div>

                            </div>



                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('cedula') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="cedula" class="col-md-3 control-label">cedula</label>

                                    <div class="col-md-9">
                                        <input id="cedula" type="cedula" class="form-control" name="cedula" value="{{ $elemento->cedula}}" required>

                                    </div>
                                </div>

                            </div>



                        <div class="col-sm-6"  >

                     <div class="col-md-3">
                            <label for="tipocontrato"  class="col-md-4 form-control" style="border:none">Tipo de Documento</label>
                             </div>

                            <div class="col-md-9">
                                <select class="form-control" id="tipodocumento" class="form-control" name="tipodocumento" >
                                                    <option value="1">Cedula</option>
                                                    <option value="2">Tarjeta de Identidad</option>
                                                    <option value="3">Cedula de Extranjeria</option>
                                                    <option value="4">Visa</option>
                                                    <option value="5">Pasaporte</option>
                                                    <option value="6">Nit</option>
                                                 
                                                </select>
                            </div>
                    </div>
                        </div>


                        <div class="row" style="margin-top: 20px">
                            <div class="col-md-6">
                            <div class="form-group {{ $errors->has('pais') ? ' has-error' : '' }}">
                                <label  id="milabel" for="pais" class="col-md-3 control-label">Pais</label>
                                <div class="col-md-9">
                                    <select id="pais" class="form-control" name="pais" required >
                                        <option>Colombia</option>
                                        <option>Venezuela</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('departamento') ? ' has-error' : '' }}">
                                <label  id="milabel" for="departamento" class="col-md-3 control-label">Departamento</label>
                                <div class="col-md-9">
                                    <select id="departamento" class="form-control" name="departamento" required >
                                        <option>Colombia</option>
                                        <option>Venezuela</option>
                                    </select>
                                </div>

                            </div>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('municipio') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="municipio" class="col-md-3 control-label">Municipio</label>
                                    <div class="col-md-9">
                                        <select id="municipio" class="form-control" name="municipio" required >
                                            <option>Cucuta</option>
                                            <option>Medellin</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                                <div class="col-md-6">
                                <div class="form-group {{ $errors->has('direccion') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="direccion" class="col-md-3 control-label">Direccion</label>
                                    <div class="col-md-9">
                                        <input id="direccion" type="text" class="form-control" name="direccion" value="{{ $elemento->direccion }}" required>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('celular_1') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="celular1" class="col-md-3 control-label">Celular 1</label>
                                    <div class="col-md-9">
                                        <input id="celular_1" type="text" class="form-control" name="celular_1"  value="{{ $elemento->celular_1 }}" required>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('celular_2') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="celular2" class="col-md-3 control-label">Celular 2</label>
                                    <div class="col-md-9">
                                        <input id="celular_2" type="text" class="form-control" name="celular_2" value="{{$elemento->celular_2 }}" required>
                                    </div>

                                </div>
                            </div>

                        </div>





                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('tel_fijo') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="tel_fijo" class="col-md-5 control-label">Telefono Fijo</label>
                                    <div class="col-md-7">
                                        <input id="tel_fijo" type="text" class="form-control" name="tel_fijo" value="{{$elemento->tel_fijo}}" required>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('observacion') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="observacion" class="col-md-3 control-label">Observacion</label>
                                    <div class="col-md-9">
                                        <input id="observacion" type="text" class="form-control" name="observacion" value="{{$elemento->observacion }}" required>
                                    </div>

                                </div>
                            </div>

                        </div>


                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('cupo') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="tel_fijo" class="col-md-5 control-label">Cupo</label>
                                    <div class="col-md-7">
                                        <input id="cupo" step="0.01" type="number" class="form-control" name="cupo" value="{{$elemento->cupo}}" required>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('Plazo') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="observacion" class="col-md-3 control-label">Plazo</label>
                                    <div class="col-md-9">
                                        <input id="plazo" type="number" class="form-control" name="plazo" value="{{$elemento->plazo }}" required>
                                    </div>

                                </div>
                            </div>

                        </div>







                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('tipo_cliente') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="tipo_cliente_id" class="col-md-5 control-label">Tipo de Precio</label>
                                    <div class="col-md-7">
                                        <select id="tipo_cliente_id" class="form-control" name="tipo_cliente_id" required >
                                            <option value="1">Precio Publico</option>
                                            <option value="2">Precio Distribuidor</option>
                                            <option value="3">Precio Especial</option>
                                            
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('mensualidad') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="mensualidad" class="col-md-3 control-label">Mensualidad</label>
                                    <div class="col-md-9">
                                        <input id="mensualidad" type="number" step="0.01" class="form-control" name="mensualidad" value="{{$elemento->mensualidad}}" required>
                                    </div>

                                </div>
                            </div>

                        </div>




                    <div class="col-sm-12" style="padding-top: 30px">
                                         @if($ruta =="Cliente_update" )
                                         <div class="col-sm-6">
                                         <input type="hidden" name="id" value="{{$id}}">
                                        <input type="submit" id="save_elemento" value="Actualizar" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Cliente')}}" class="btn col-md-10 btn-warning col-md-offset-1 "  >
                                        Volver a Inicio
                                        </a>
                                        </div>
                                       @elseif($ruta =="Cliente_create" )
                                       <div class="col-sm-6">
                                        <input type="submit" id="save_elemento" value="Crear" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Cliente')}}" class="btn btn-warning col-md-10 col-md-offset-1 "  >
                                       Volver a Inicio
                                        </a>
                                        </div>
                                       @else

                                    <a href="{{ route($ruta)}}" class="btn col-md-6 col-md-offset-3" style="background: #a50029; color: #fff" >
                                        Volver a Inicio
                                    </a>
                                        @endif
                                    
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
</div>
@endsection
@section('script')
<script >
    $(document).ready(function($) {

         $("#tipodocumento").val("{{$elemento->tipodocumento}}");
         $("#departamento").val("{{$elemento->departamento}}");
         $("#municipio").val("{{$elemento->municipio}}");
         $("#tipo_cliente_id").val("{{$elemento->tipo_cliente_id}}");
            });
        </script>
        @endsection