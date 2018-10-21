
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
                <div class="panel-heading">Sintec Plus:: Modulo de Bancos</div>

                <div class="panel-body" style="text-align: center;">
					<h1>Esta opcion ya no esta disponible en esta version, 
					consulte consulte con el Proveedor</h1>
					<img width="100%" height="300px" src="{{ URL::asset('images/sintec/contacto.png')}}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection