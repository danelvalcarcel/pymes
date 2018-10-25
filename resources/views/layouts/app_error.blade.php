<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/4.5.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('common/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('common/css/jquery-ui-1.10.0.custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.googleapis.com.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ace.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ace-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ace-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="http://programandoweb.net/3rdparty/colorbox/colorbox.css" />
    
    
        <script src="{{ URL::asset('js/ace-extra.min.js') }}"></script>
</head>
<style type="text/css" media="screen">

.main-content{
   background-image: url('{{ asset('images/fondo_c.png') }}');
    min-height: 800px
}
.main-content div.list-group-item a{
   background-image: url('{{ asset('images/fondo_c.png') }}')
   color:#fff !important;
}
.main-content, .main-content .main-content-inner{
   background-image: url('{{ asset('images/fondo_c.png') }}')
} 
.main-content-inner .col-md-12 div.panel.panel-default{
    background: none;
}   

.main-content-inner .col-md-12 div.panel.panel-default div{
    background: none;
}
div.panel-heading{

    color:#fff !important;
}
.main-content a, .main-content p, .main-content tr, .main-content td, .main-content h1, .main-content h2, label, h3, strong, h4, h5{
     color:#fff !important;
}
.main-content table thead tr td h3{
     color:#000 !important;
}
table.table thead tr td{
    color:#000 !important;
}

#myModal a, #myModal p, #myModal tr, #myModal td, #myModal h1, #myModal h2, #myModal label, #myModal h3, #myModal h4, div.modal-content h5,div.modal-content strong {
     color:#000 !important;
     font-size: 14px;
}
label
{
font-size: 16px !important;
background:none;
}
label.form-control
{
font-size: 16px !important;
background:none;
}
</style>
<body class="no-skin"  style="zoom:100%">
    <div id="app">
       <div id="navbar" class="navbar navbar-default  ace-save-state">
        
            <div class="navbar-container ace-save-state" id="navbar-container">
                
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="navbar-header pull-left">
                    <a href="{{url("/")}}" class="navbar-brand">
                        <small>
                           <div style="text-align: center; color: #fff; padding: 0; margin: 0"><h2 style="padding: 0; margin: 0;"><strong>SINTEC PLUS</strong></h2></div>
                        </small>
                    </a>
                </div>
                                 
                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="gray dropdown-modal">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="ace-icon fa fa-tasks"></i>
                                <span class="badge badge-gray">4</span>
                            </a>

                            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="ace-icon fa fa-check"></i>
                                    4 Tareas para Completar
                                </li>

                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar">
                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Ganancia Neta</span>
                                                    <span class="pull-right">65%</span>
                                                </div>

                                                <div class="progress progress-mini">
                                                    <div style="width:65%" class="progress-bar"></div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Incremento Activos</span>
                                                    <span class="pull-right">35%</span>
                                                </div>

                                                <div class="progress progress-mini">
                                                    <div style="width:35%" class="progress-bar progress-bar-danger"></div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Bajas</span>
                                                    <span class="pull-right">15%</span>
                                                </div>

                                                <div class="progress progress-mini">
                                                    <div style="width:15%" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Funcionamiento</span>
                                                    <span class="pull-right">90%</span>
                                                </div>

                                                <div class="progress progress-mini progress-striped active">
                                                    <div style="width:90%" class="progress-bar progress-bar-success"></div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown-footer">
                                    <a href="#">
                                        Ver mas Detalles
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="light-blue dropdown-modal">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <span class="user-info">
                                    <small id="reloj"></small>
                                                                    
                                </span>

                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>

                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">                              
                                <li class="dropdown-header">Mis módulos</li>
                                
                            
                                <li class="divider"></li>
                                <li class="dropdown-header">Mis Datos</li>                              
                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-cog"></i>
                                        Settings
                                    </a>
                                </li>

                                <li>
                                    <a href="">
                                        <i class="ace-icon fa fa-user"></i>
                                        Profile
                                    </a>
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="ace-icon fa fa-power-off"></i>
                                        Logout
                                    </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                           
                                            {{ csrf_field() }}
                                        </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- /.navbar-container -->
        </div>

        
        @yield('content')

         <footer class="footer">
        <div class="footer-inner">
            <div class="footer-content">
               <p class="text-left">Powered by  www.sintecpos.com</p>
            </div>
        </div>
    </footer> 
    </div>
    
    <!-- Scripts -->

    
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="http://programandoweb.net/3rdparty/colorbox/jquery.colorbox-min.js"></script>
        <script src="{{ asset('js/ace.min.js') }}"></script>
        <script src="{{ asset('js/ace-elements.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('common/js/jquery-2.1.4.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('common/js/jquery-ui-1.10.0.custom.min.js') }}"></script>       
        <script type="text/javascript" src="{{ asset('common/js/bootstrap.min.js')}}"></script>      
        <script type="text/javascript" src="{{ asset('common/js/funciones.js')}}"></script>  
        <script type="text/javascript" src="{{ asset('common/js/holder.js')}}"></script>
        <script>
            $(document).ready(function($) {


                    if( $("div.sidebar-collapse i").hasClass("fa-angle-double-right")){
             $("div.texto_menu").css("display","none")
             $("ul#desplegable1").css({"margin-left":"40px","margin-top":"-28px"})
        }else{
          
            $("div.texto_menu").css("display","inline-block")
             $("ul#desplegable1").css({"margin-left":"190px","margin-top":"-28px"})
        }
        
        
       
         

         
  $("div.sidebar-collapse").on("click", function(e){

        if( $("div.sidebar-collapse i").hasClass("fa-angle-double-right")){
             $("div.texto_menu").css("display","inline-block")
                        $("ul#desplegable1").css({"margin-left":"190px","margin-top":"-28px"})
        }else{
            $("div.texto_menu").css("display","none")
             $("ul#desplegable1").css({"margin-left":"40px","margin-top":"-28px"})
        }
                          if( $("div.sidebar-collapse i").hasClass("fa-angle-double-right")){
             $("div.texto_menu").css("display","none")
             $("ul#desplegable1").css({"margin-left":"40px","margin-top":"-28px"})
        }else{
            $("div.texto_menu").css("display","inline-block")
             $("ul#desplegable1").css({"margin-left":"190px","margin-top":"-28px"})
        }
        });
         
  $("div.sidebar-collapse").on("click", function(e){
        if( $("div.sidebar-collapse i").hasClass("fa-angle-double-right")){
             $("div.texto_menu").css("display","inline-block")
                        $("ul#desplegable1").css({"margin-left":"190px","margin-top":"-28px"})
        }else{
            $("div.texto_menu").css("display","none")
             $("ul#desplegable1").css({"margin-left":"40px","margin-top":"-28px"})
        }


            });

  $("div.sidebar-collapse").click();
  $("div.sidebar-collapse").click();

  

  });
           

        </script>
          @yield('script')
</body>
</html>
