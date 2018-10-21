
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
					<h1>Opcion en Desarrollo</h1>
					<img width="100%" height="300px" src="{{ URL::asset('images/sintec/desarrollo.jpg')}}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection