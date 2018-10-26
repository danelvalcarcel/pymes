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
div.main-content a
{
    border-radius: 5px !important;
}
input, select, option{
    color: #000 !important;
}
          .nav-tabs > li.active, div.panel.panel-default .nav-tabs > li.active > a{
        background-color: none !important;
        background: none !important;
    }   
    div.modal-body label{
        
        color: #000 !important;
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
                           <div style="text-align: center; color: #fff; padding: 0; margin: 0"><h3 style="padding: 0; margin: 0;"><strong>SINTEC +</strong> :: {{$user->entidad->nombre}}</h3></div>
                        </small>
                    </a>
                </div>
                                 
                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">

                        <li class="gray dropdown-modal" style="display: none;">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="ace-icon fa fa-tasks"></i>
                                <span class="badge badge-gray">4</span>
                            </a>

                            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="ace-icon fa fa-check"></i>
                                    4 Tareas para Completar
                                </li>



                            </ul>
                        </li>
                         <li style="color:#fff; border: none; padding-right: 4px">
                            
                           
                         </li>
                         <li >
                            <a id="fecha_sistema" style="font-size: 17px; display: inline-block; background: none; text-decoration: none;"><?php echo date("d M Y", strtotime($user->fecha_registro)) ?></a>
                           <strog id="hora" style="color: #fff !important; display: inline-block;"> 00:00:00</strog>
                             
                         </li>
                        
                        <li class="light-blue dropdown-modal">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <span class="user-info">
                                    <small id="reloj" style="padding-top: 7px">{{$user->nombres}} </small>
                                                                   
                                </span>

                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>

                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">                     
                               <li class="dropdown-header">{{$user->entidad->nombre}}</li>
                                <!--<li class="dropdown-header">Mis módulos</li>-->
                                
                            @php
                            $mismodulos = explode("-", $user->modulos_id);
                           
                            @endphp

                            @foreach($Modulos as $data)

                            @if(in_array($data->id_esquema,$mismodulos))
                                <li>
                                <a href="{{route($data->descripcion.".index")}}">
                                       {{$data->esquema}}
                                </a>
                                </li>
                            @endif
                            
                                            
                            @endforeach
                
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
                                        
                                    </a>
                                </li>
                                <li style="padding-left: 3px; color:#000" >
                                  <a  id="cambiar_fecha">Cambiar Fecha</a>
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
               <p class="text-left">Powered by  <a href="https://www.sintecpos.com/">www.sintecpos.com</a></p>
            </div>
        </div>
    </footer> 
    </div>


        <div class="modal fade" id="inforModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header bg-danger" style="padding-bottom: 0; padding-top: 10px">
                    <h4 class="modal-title" style="text-align: center"><strong>
                            Información
                        </strong></h4>
                    <button type="button" id="cerrar_info"    class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  bg-danger" style="padding-top: 0">
                    <strong> <p id="infor_mostrar" style=" font-weight:bolder;text-align: center;margin-top: 0; color: #000">

                    </p></strong>
                    <div class="col-md-6 col-md-offset-3" id="estado_operacion" ></div>
                </div>

            </div>
        </div>
    </div>
    


            <div class="modal fade" id="inforModal2">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header " style="padding-bottom: 0; padding-top: 10px">
                    <h4 class="modal-title" style="text-align: center"><strong>
                            Cambio de Fecha
                        </strong></h4>
                    <button type="button" id="cerrar_info"    class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  " style="padding-top: 0">
                    <div class="row">
                        <div class="col-sm-4">
                         <label for="">Fecha de Usuario</label>
                         
                        </div>
                        <div class="col-sm-4">
                      <input class="form-control" style=" display: inline-block;  border:none; background: none; color:#000 !important; padding: 0; margin: 0;" type="date" id="fecha_registro" name="fecha_registro" value="{{$user->fecha_registro}}" placeholder="">      
                        </div>
                        <div class="col-sm-12" style="text-align: center;">
                            <input type="button" class="btn btn-success col-sm-6 col-sm-offset-3" id="cambiar_fecha_boton" name="Guardar" value="Cambiar" placeholder="">
                        </div>
                    </div>

                      
                    
                    <div class="col-md-6 col-md-offset-3" id="estado_operacion" ></div>
                </div>

            </div>
        </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.1.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/FitText.js/1.1/jquery.fittext.min.js"></script>
        <script>
        
        
        
        
        
        
            $(document).ready(function($) {


                            $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });


                            $("#cambiar_fecha").on("click", function(){
                                $("#inforModal2").modal();
                            });
                $("#cambiar_fecha_boton").on("click", function(){

                var fecha = $("#fecha_registro").val();
                                    $.ajax({
                    type:"Post",
                    dataType:"json",
                    data:{fecha:fecha},
                    url:"{{route('Cambiar_Fecha')}}",
                    success: function(resp){
                        if(resp["message"]==="OK"){
                            $("#fecha_sistema").text(resp["fecha"]);
                            $("#inforModal .modal-header").addClass("bg-success");
                            $("#inforModal .modal-body").addClass("bg-success");
                            $("#inforModal .modal-header").removeClass("bg-danger");
                            $("#inforModal .modal-body").removeClass("bg-danger");
                             $("p#infor_mostrar").empty();
                            $("p#infor_mostrar").text("Fecha Actualizada Correctamente");
                            $("#inforModal").modal().appendTo('#inforModal2');
                        }else{
                            $("#inforModal .modal-header").removeClass("bg-success");
                            $("#inforModal .modal-body").removeClass("bg-success");
                            $("#inforModal .modal-header").addClass("bg-danger");
                            $("#inforModal .modal-body").addClass("bg-danger");
                             
                             $("p#infor_mostrar").empty();
                            $("p#infor_mostrar").text("Se ha presentado un error");
                            $("#inforModal").modal().appendTo('#inforModal2');
                            $("#fecha_registro").val("");
                        }
                    },
                        error:function(){
                            $("#inforModal .modal-header").removeClass("bg-success");
                            $("#inforModal .modal-body").removeClass("bg-success");
                            $("#inforModal .modal-header").addClass("bg-danger");
                            $("#inforModal .modal-body").addClass("bg-danger");
                             
                             $("p#infor_mostrar").empty();
                            $("p#infor_mostrar").text("Se ha presentado un error");
                            $("#inforModal").modal().appendTo('#inforModal2');
                            $("#fecha_registro").val("");
                        }

                            


                        });

                });




                
                $('#hora').fitText(1.3).css("font-size","18px");;

                function update() {
                  $('#hora').text(moment().format('H:mm:ss')).css("font-size","18px");
                }

                setInterval(update, 1000);

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

  
    
         $('li.dropdown-submenu a.test').on("click", function(e){

    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });





    
    
  });
           

        </script>
          @yield('script')
</body>
</html>
