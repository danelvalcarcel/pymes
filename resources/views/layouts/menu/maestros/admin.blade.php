    
    <div id="sidebar" class="sidebar  responsive ace-save-state">

        <script type="text/javascript">

          try{ace.settings.loadState('sidebar')}catch(e){}

        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">

          <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">

            <button class="btn btn-success">

              <i class="ace-icon fa fa-signal"></i>

            </button>



            <button class="btn btn-info">

              <i class="ace-icon fa fa-pencil"></i>

            </button>



            <button class="btn btn-warning">

              <i class="ace-icon fa fa-users"></i>

            </button>



            <button class="btn btn-danger">

              <i class="ace-icon fa fa-cogs"></i>

            </button>

          </div>



          <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">

            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>

          </div>

        </div><!-- /.sidebar-shortcuts -->



        <ul class="nav nav-list">

          <li class="active">

            <a>

              <span class="menu-text">&nbsp;&nbsp; {{$nombre_modulo}} </span>

            </a>

            <b class="arrow"></b>

          </li>

                 



                                        <li  style="padding-top:15px">

                                                <div class="dropdown">

                                            <div style="padding-left:17px" class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                <span title="Maestros" style="display:inline-block" class="glyphicon glyphicon-user" aria-hidden="true"></span>

                                                

                                             <div style="display:inline-block; margin-left:14px; font-size:16px" class="texto_menu">Empresas</div>

                                            </div>

                                              <ul id="desplegable1" class="dropdown-menu">

                                                <li><a tabindex="-1" href="{{route('All_Entidades')}}">Entidaes</a></li>
                                                <li><a tabindex="-1" href="{{route('All_Sede')}}">Sedes</a></li>

                                                
                                              </ul>

                                            </div>

                                        </li>

          

          

          

          <li  style="padding-top:15px">

                                  <div class="dropdown">

                              <div style="padding-left:17px" class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                  <span title="Mantenimientos" style="display:inline-block" class="glyphicon glyphicon-wrench" aria-hidden="true"></span>

                                  

                               <div style="display:none; margin-left:14px; font-size:16px" class="texto_menu">Usuarios</div>

                              </div>

                                <ul id="desplegable1" class="dropdown-menu">

                                  <li><a tabindex="-1" href="{{route('All_users')}}">Usuarios</a></li>

                                
                                </ul>

                              </div>

          </li>

          

          

          

          

            <li  style="padding-top:15px; display;none">

          

                <div class="dropdown">

  <div style="padding-left:17px" class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

      <span title="Consultas" style="display:inline-block" class="glyphicon glyphicon-search" aria-hidden="true"></span>

      

  <div style="display:none; margin-left:14px; font-size:16px" class="texto_menu">Maestros</div>
  </div>
    <ul id="desplegable1" class="dropdown-menu">
     <li><a tabindex="-1" href="{{route('All_Arl')}}">ARL</a></li>
     <li><a tabindex="-1" href="{{route('All_Eps')}}">EPS</a></li>
     <li><a tabindex="-1" href="{{route('All_Epp')}}">AFP</a></li>
    <li><a tabindex="-1" href="">GRUPOS</a></li>
     <li><a tabindex="-1" href="">ELEMENTOS</a></li>
     <li><a tabindex="-1" href="{{route('All_Tipo_documento')}}">TIPOS DE DOCUMENTOS</a></li>
     <li><a tabindex="-1" href="{{route('All_Enfermedade')}}">TIPOS ENFERMEDADES</a></li>
     <li><a tabindex="-1" href="{{route('All_Motivo')}}">TIPOS MOTIVOS</a></li>
     <li><a tabindex="-1" href="{{route('All_Profesione')}}">PROFESIONES</a></li>
     <li><a tabindex="-1" href="{{route('All_CajaCompensacion')}}">CAJA COMPENSACION</a></li>
          <li class="dropdown-submenu">
        <a class="test" tabindex="-1" >MANTENIMIENTO<span class="caret"></span></a>
        <ul class="dropdown-menu" style="margin-left:170px; margin-top:-33px">
                                                <li><a tabindex="-1" href="{{route('All_Puc')}}">PUC</a></li>
                                                <li><a tabindex="-1" href="{{route('All_TipoIngreso')}}">Tipo Ingresos</a></li>
                                                <li><a tabindex="-1" href="{{route('All_TipoEgreso')}}">Tipo Egresos</a></li>

                                              <li><a tabindex="-1" href="{{route('All_Categoria')}}">Categorias</a></li>
                                              <li><a tabindex="-1" href="{{route('All_Banco')}}">Bancos</a></li>
                                              <li><a tabindex="-1" href="{{route('All_Articulo')}}">Articulos</a></li>
                                               <li><a tabindex="-1" href="{{route('All_Medida')}}">Unidades</a></li>



           
        </ul> 
      </li>
    </ul>
  </div>
</li>



        </ul><!-- /.nav-list -->



        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">

          <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>

        </div>

      </div>