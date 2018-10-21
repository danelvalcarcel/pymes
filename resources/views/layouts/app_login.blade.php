<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
  <!-- Favicon-->
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('css/misestilos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('font-awesome/4.5.0/css/font-awesome.min.css') }}" />
		<!-- page specific plugin styles -->
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->   
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminLTE/custom.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<style>
html{
 background-image:url("{{asset('images/sintec2.jpg')}}");

}
body{
background:none;
}
</style>

<body class="hold-transition" style="height: 420px;">
	<div class="" style="padding-top: 30px;" >
		     @yield('content')

	</div>
		  
		  <div align="center" style="font-size: 18px; color:#3c8dbc"><b>2018 Sintec - <a href="#" style="border:none">Términos</a></b></div>
		
<script src="{{ URL::asset('js/jquery-2.1.4.min.js')}}"></script>	
<script src="{{ URL::asset('js/bootstrap.min.js')}}"></script>	
<script>

</script>
</body>
</html>