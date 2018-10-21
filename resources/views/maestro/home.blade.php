
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
                <div class="panel-heading">Sintec Plus:: Modulo de Maestros</div>

                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
