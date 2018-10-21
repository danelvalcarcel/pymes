    
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

                                  

                               <div style="display:inline-block; margin-left:14px; font-size:16px" class="texto_menu">Compras</div>

                              </div>

                                <ul id="desplegable1" class="dropdown-menu">

                                  <li><a tabindex="-1" href="/contratacion/tipos_contratos">Registrar Compra</a></li>

                                  <li><a tabindex="-1" href="/contratacion/all_criterios_evaluacion">Reimprimir Compra</a></li>

                                  <li><a tabindex="-1" href="/contratacion/articulos_servicios">Devoluciones</a></li>

                                  <li><a tabindex="-1" href="/contratacion/tipos_actas">Reimprimir Devoluciones</a></li>


                                </ul>

                              </div>

          </li>

          

          

          

          <li  style="padding-top:15px">

                                  <div class="dropdown">

                              <div style="padding-left:17px" class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                  <span title="Mantenimientos" style="display:inline-block" class="glyphicon glyphicon-wrench" aria-hidden="true"></span>

                                  

                               <div style="display:none; margin-left:14px; font-size:16px" class="texto_menu">Ordenes</div>

                              </div>

                                <ul id="desplegable1" class="dropdown-menu">

                                  <li><a tabindex="-1" href="/contratacion/comite_seguimiento">Comite de Seguimiento</a></li>

                                  <li><a tabindex="-1" href="/contratacion/precontratos">Orden de Compra</a></li>

                                  <li><a tabindex="-1" href="/contratacion/licitaciones">Reimprimir Orden</a></li>

                                   <li><a tabindex="-1" href="/contratacion/oferentes">Eliminar Orden</a></li>


                                </ul>

                              </div>

          </li>

          

          

          

          

            <li  style="padding-top:15px; display;none">

          

                <div class="dropdown">

  <div style="padding-left:17px" class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

      <span title="Consultas" style="display:inline-block" class="glyphicon glyphicon-search" aria-hidden="true"></span>

      

   <div style="display:none; margin-left:14px; font-size:16px" class="texto_menu">Informes</div>

  </div>

    <ul id="desplegable1" class="dropdown-menu">

     <li><a tabindex="-1" href="/contratacion/estado_licitaciones">Compras</a></li>

     <li><a tabindex="-1" href="/contratacion/estado_contratos">Devoluciones</a></li>

    </ul>

  </div>

        </ul><!-- /.nav-list -->



        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">

          <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>

        </div>

      </div>