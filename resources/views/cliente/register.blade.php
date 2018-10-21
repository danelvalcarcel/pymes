
@extends('layouts.app')

@section('content')
@include('layouts.menu.ventasc.admin')
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
                    <form class="form-horizontal" role="form" method="GET" action="{{ route('Clientes.create') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('firts_name') ? ' has-error' : '' }}">
                                    <label id="milabel" for="firts_name" class="col-md-3 control-label">Nombres</label>

                                    <div class="col-md-9">
                                        <input id="firts_name" type="text" class="form-control" name="firts_name" value="{{ old('firts_name') }}" required autofocus>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="last_name" class="col-md-3 control-label">Apellidos</label>

                                    <div class="col-md-9">
                                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>

                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="email" class="col-md-3 control-label">E-Mail</label>

                                    <div class="col-md-9">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    </div>
                                </div>

                            </div>



                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('cedula') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="cedula" class="col-md-3 control-label">cedula</label>

                                    <div class="col-md-9">
                                        <input id="cedula" type="cedula" class="form-control" name="cedula" value="{{ old('cedula') }}" required>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
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
                                        <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" required>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('celular_1') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="celular1" class="col-md-3 control-label">Celular 1</label>
                                    <div class="col-md-9">
                                        <input id="celular_1" type="text" class="form-control" name="celular_1"  value="{{ old('celular_1') }}" required>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('celular_2') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="celular2" class="col-md-3 control-label">Celular 2</label>
                                    <div class="col-md-9">
                                        <input id="celular_2" type="text" class="form-control" name="celular_2" value="{{ old('celular_2') }}" required>
                                    </div>

                                </div>
                            </div>

                        </div>





                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('tel_fijo') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="tel_fijo" class="col-md-5 control-label">Telefono Fijo</label>
                                    <div class="col-md-7">
                                        <input id="tel_fijo" type="text" class="form-control" name="tel_fijo" value="{{ old('tel_fijo') }}" required>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('observacion') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="observacion" class="col-md-3 control-label">Observacion</label>
                                    <div class="col-md-9">
                                        <input id="observacion" type="text" class="form-control" name="observacion" value="{{ old('observacion') }}" required>
                                    </div>

                                </div>
                            </div>

                        </div>






                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('tipo_cliente') ? ' has-error' : '' }}">
                                    <label  id="milabel" for="tipo_cliente_id" class="col-md-5 control-label">Tipo de Cliente</label>
                                    <div class="col-md-7">
                                        <select id="tipo_cliente_id" class="form-control" name="tipo_cliente_id" required >
                                            <option value="1">Cliente</option>
                                            <option value="2">Cliente Provedor</option>
                                            <option value="3">Cliente Operador</option>
                                            <option value="4">Cliente Super Admin</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                        </div>




                        <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                        <div class="form-group ">
                            <div class="col-md-12">
                                <button type="submit"  class="btn btn-primary col-md-12" id="miboton">
                                    Register
                                </button>
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
</div>
@endsection