
@extends('layouts.app_login')

@section('content')
<div class="container" style="max-width: 340px">
     <div style="text-align: center; color: #fff"><h2><strong>SINTEC +</strong></h2></div>
    <div class="row" style="background-color: #3c8dbc">
          <div class="login-wrap"></div>

        <div class="col-md-12 " style="background-color: #3c8dbc">
            <div class="panel " style="background-color: #3c8dbc; margin-top:10px">
                @if (session('status'))
                    <div class="alert alert-danger">
                        {{ session('status') }}
                    </div>
                    @endif

                <!--<div class="panel-heading">Login</div>-->

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login_auth') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                <span style="padding-right:10px" class="glyphicon glyphicon-user form-control-feedback"></span>
                                 

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>
                                <span style="padding-right:10px" class="glyphicon glyphicon-lock form-control-feedback"></span>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar clave
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-8 col-sm-offset-2">
                                <button  type="submit" class="btn  form-control" style="background: #e74c3c; color:#fff">
                                    Post <i class="fa fa-sign-in"></i></button>
                                </button>

                                <button   type="submit" class="btn  form-control" style="background: #e74c3c; color:#fff; margin-top: 15px">
                                    Financiero <i class="fa fa-sign-in"></i></button>
                                </button>
                                <div style="text-align: center; color: #fff">
                                <a class="btn btn-link" style="color: #fff" href="{{ route('password.request') }}">
                                    olvido su contraseña
                                </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
