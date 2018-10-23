
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
                <div class="panel-heading">SINTEC +:1.001(2018)</div>

                <div class="panel-body">
                   @php
                    $mismodulos = explode("-", $user->modulos_id);
                   
                    @endphp

                    @foreach($Modulos as $data)

                    @if(in_array($data->id_esquema,$mismodulos))

                        <div class="list-group-item col-md-3 col-sm-4" style="text-align: center; border:none; float: left; color: #fff; height: 200px">
                        <a href='{{route($data->descripcion.".index")}}' style="color: #fff">
                        <img width="100" height="100" src="{{ URL::asset('images/sintec/'.$data->descripcion.'.png')}}">
                        <h3>{{$data->esquema}}</h3>
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
