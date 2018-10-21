
@extends('layouts.app_error')

@section('content')
@include("layouts.menu.admin")
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">
                 @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                <div style="text-align: center;" class="panel-heading">Error 404 - Direccion Erronea</div>

                <div class="panel-body" style="text-align: center;">
                    <h2>La direccion a la que quieres Acceder no existe, Elige una opcion del menu de inicio</h2>
                    <h3><a class="btn btn-info" href="{{url('/')}}">Inicio</a></h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
