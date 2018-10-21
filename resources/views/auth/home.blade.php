
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
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                   @php
                    $mismodulos = explode("-", $user->modulos_id);
                   
                    @endphp

                    @foreach($Modulos as $data)

                    @if(in_array($data->id_esquema,$mismodulos))

                        <div class="list-group-item col-md-3 col-sm-4" style="text-align: center; border:none">
                        <a href="{{route($data->descripcion.".index")}}">
                        <img width="100" height="100" src="{{ URL::asset('images/sintec/'.$data->descripcion.'.png')}}">
                        <h2>{{$data->esquema}}</h2>
                        </a>
                        </div>
                            
                    
                    @endif
                    
                                    
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
