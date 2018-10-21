
@extends('layouts.app')

@section('content')
@include('layouts.menu.thumano.admin')
<div class="main-content">
    <div class="main-content-inner">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div style="font-size: 20px; display: inline-block; height: 100%; vertical-align: middle;">
                        Empleados
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="panel-body">
            <form id="form_sueldo" enctype="multipart/form-data" action="{{ route($ruta)}}" method="post">
                 {{ csrf_field() }}
                <div class="row">


                <div class="col-md-6" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="contrato">Contrato</label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control" id="contrato" type="text" name="contrato" value="{{$elemento->contrato}}"  >
                    </div>
                </div>



                <div class="col-md-6" style=" margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="documento">Documento</label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control" id="documento" type="number" name="documento" value="{{$elemento->documento}}" >
                    </div>
                </div>




                <div class="col-md-6" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="fecha_nacimiento">Fecha Nacimiento</label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control"  id="fecha_nacimiento" type="date" name="fecha_nacimiento"  value="{{$elemento->fecha_nacimiento}}"  >
                    </div>
                </div>



                <div class="col-md-6" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="nombres">Nombres</label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control" id="nombres" type="text" name="nombres" value="{{$elemento->nombres}}"  >
                    </div>
                </div>




                <div class="col-md-6" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="apellidos">Apellidos</label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control" id="apellidos" type="text" name="apellidos" value="{{$elemento->apellidos}}"  >
                    </div>
                </div>

                <div class="col-md-6" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="direccion">Direccion</label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control" id="direccion" type="text" name="direccion" value="{{$elemento->direccion}}"  >
                    </div>
                </div>


                <div class="col-md-6" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="telefono">Telefono</label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control" id="telefono" type="text" name="telefono" value="{{$elemento->telefono}}"  >
                    </div>
                </div>


                <div class="col-md-6" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="genero"  class="col-md-4 form-control" style="border:none">Genero</label>
                             </div>

                            <div class="col-md-8">
                                <select required  id="genero" class="form-control" name="genero" >
                                    <option value="1">Masculino</option>
                                    <option value="0">Femenino</option>
                                </select>
                            </div>
                 </div>


                 <div class="col-md-6" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="talla_camisa">Talla Camisa</label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control" id="talla_camisa" type="text" name="talla_camisa" value="{{$elemento->talla_camisa}}"  >
                    </div>
                </div>



                <div class="col-md-6" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="talla_pantalon">Talla Pantalon</label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control" id="talla_pantalon" type="text" name="talla_pantalon" value="{{$elemento->talla_pantalon}}"  >
                    </div>
                </div>


                 <div class="col-md-6" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="talla_zapatos">Talla Zapatos</label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control" id="talla_zapatos" type="text" name="talla_zapatos" value="{{$elemento->talla_zapatos}}"  >
                    </div>
                </div>



                <div class="col-md-6" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="rh"  class="col-md-4 form-control" style="border:none">Rh</label>
                             </div>

                            <div class="col-md-8">
                                <select required  id="rh" class="form-control" name="rh" >
                                    <option value="O+">O-</option>
                                    <option value="O-">O+</option>
                                    <option value="A-">A-</option>
                                    <option value="A+">A+</option>
                                    <option value="B-">B-</option>
                                    <option value="B+">B+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="AB+">AB+</option>
                                </select>
                            </div>
                 </div>



                 <div class="col-md-6" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="fecha_ingreso">Fecha Ingreso</label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control"  id="fecha_ingreso" type="date" name="fecha_ingreso"  value="{{$elemento->fecha_nacimiento}}"  >
                    </div>
                </div>


                <div class="col-md-6" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="fecha_terminacion">Fecha Terminacion</label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control"  id="fecha_terminacion" type="date" name="fecha_terminacion"  value="{{$elemento->fecha_nacimiento}}"  >
                    </div>
                </div>


                 <div class="col-md-6" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="fondo" required  class="col-md-4 form-control" style="border:none">Pertence a Fondo</label>
                             </div>

                            <div class="col-md-8">
                                <select  id="fondo" class="form-control" name="fondo" >
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                 </div>


            <div class="col-md-6" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="idtiponomina"  class="col-md-4 form-control" style="border:none">Tipo de Nomina</label>
                             </div>

                            <div class="col-md-8">
                                <select required  id="idtiponomina" class="form-control" name="idtiponomina" >
                                    @foreach($tipos_nomina as $data)
                                    <option value="{{$data->idtiponomina}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                 </div>
                

            
            <div class="col-md-6" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="idcargo"  class="col-md-4 form-control" style="border:none">Cargo</label>
                             </div>

                            <div class="col-md-8">
                                <select required id="idcargo" class="form-control" name="idcargo" >
                                    @foreach($cargos as $data)
                                    <option value="{{$data->idcargo}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                 </div>






            


                <div class="col-md-6" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="idcentro"  class="col-md-4 form-control" style="border:none">Centro de Trabajo</label>
                             </div>

                            <div class="col-md-8">
                                <select required id="idcentro" class="form-control" name="idcentro" >
                                    @foreach($Centros_trabajos as $data)
                                    <option value="{{$data->idcentro}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                 </div>



                 <div class="col-md-6"  style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="sueldo">Sueldo</label>
                    </div>
                    <div class="col-md-8">
                        <input required class="form-control" id="sueldo" type="text" name="sueldo" value="{{substr($elemento->sueldo,0,-3)}}"  placeholder="Nombres del Tipo de Nomina">
                    </div>
                </div>



                 <div class="col-md-6" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="liquidarsalud"  class="col-md-4 form-control" style="border:none">Salud</label>
                             </div>

                            <div class="col-md-8">
                              <select required id="liquidarsalud" class="form-control" name="liquidarsalud" >
                                    @foreach($Epss as $data)
                                    <option value="{{$data->ideps}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                 </div>




                  <div class="col-md-6" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="liquidarpension"  class="col-md-4 form-control" style="border:none">Pension</label>
                             </div>

                            <div class="col-md-8">
                                <select required id="liquidarpension" class="form-control" name="liquidarpension" >
                                    @foreach($Epps as $data)
                                    <option value="{{$data->idepp}}">{{$data->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                 </div>



                 <div class="col-md-6" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="nivelestudios"  class="col-md-4 form-control" style="border:none">Nivel de Estudios</label>
                             </div>

                            <div class="col-md-8">
                                <select required  id="nivelestudios" class="form-control" name="nivelestudios" >
                                    <option value="1">Sin Estudios</option>
                                    <option value="2">Primaria Incompleta</option>
                                    <option value="3">Primaria Completa</option>
                                    <option value="4">Secundaria Incompleta</option>
                                    <option value="5">Secundaria completata</option>
                                    <option value="6">Tecnica</option>
                                    <option value="7">Tegnologia</option>
                                    <option value="8">Otros Incompletos</option>
                                    <option value="9">Profesional</option>

                                </select>
                            </div>
                 </div>


                 <div class="col-sm-12">
                        @if(count($elemento->personas)>0 || count($elemento->documentos)>0)
                    <div id="personas_div" class="col-md-6 col-sm-12 panel panel-success" style="background: #2d2d2d; margin-top: 20px; background-clip: padding-box;
    border: 5px solid transparent; height: 100%">

                        <div style="text-align: center;"><h5>Personas a Cargo</h5></div>
                          
                        <div class="row" style="padding: 0 2px 0 2px">
                                        <div class="row hidden-xs">
                                     
                                            <div class="col-md-5 " style="margin-left: ">
                                                <div class="col-sm-3"><h5>Cedula</h5></div>
                                            </div>
                                           
                                            <div class="col-md-5">
                                                <div class="col-sm-8" style="text-align: center;"><h5>Nombre</h5></div>
                                            </div>

                                            <div class=" col-md-2">
                                                <div class="col-sm-1" ><h5><span  aria-hidden="true"></span></h5></div>
                                            </div>

                                        
                                    
                                    </div>
                            
                                        <!--fila--------->
                                   
                                    @foreach($elemento->personas as $persona)
                                        <div class="row">
                                          <div class="col-sm-5" style="margin-top: 5px ">
                                              <div  >
                                              <h5>{{$persona->documento}}</h5>
                                              </div>
                                        </div>
                                          <div class="col-sm-4"  style="margin-top: 5px ">
                                                <h5>{{$persona->nombres}} {{$persona->apellidos}}</h5>
                                         </div>
                                          <div class=" col-sm-3"  style="margin-top: 5px ">
                                           <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#persona_{{$persona->id}}"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i></a>
                                           <a class="btn btn-xs btn-danger"><i  class="glyphicon glyphicon-remove-circle" aria-hidden="true"></i></a>
                                         </div>
                                        </div>
                                        @endforeach
                                       
                                        <!--fila--------->
                                    </div>
                                    
                    </div>
                     @endif
                    @if(count($elemento->personas)>0 || count($elemento->documentos)>0)
                    <div id="documentos_div" class="col-md-6 col-sm-12 panel panel-success" style="background: #2d2d2d; margin-top: 20px; background-clip: padding-box;
    border: 5px solid transparent; height: 100%">
     
                        <div style="text-align: center;"><h5>Documentos</h5></div>
                           

                                     <div class="row hidden-xs">
                                     
                                            <div class="col-md-5 " style="margin-left: ">
                                                <div class="col-sm-3"><h5>Docuemnto</h5></div>
                                            </div>
                                           
                                            <div class="col-md-5">
                                                <div class="col-sm-8" style="text-align: center;"><h5>Vencimiento</h5></div>
                                            </div>

                                            <div class=" col-md-2">
                                                <div class="col-sm-1" ><h5><span class="" aria-hidden="true"></span></h5></div>
                                            </div>

                                        
                                    
                                    </div>
                            
                                        <!--fila--------->
                                    
                                    @foreach($elemento->documentos as $documento)
                                        <div class="row">
                                          <div class="col-sm-5" style="margin-top: 5px ">
                                              <div  >
                                              <h5>{{$documento->tipo_documento->nombre}}</h5>
                                              </div>
                                        </div>
                                          <div class="col-sm-4"  style="margin-top: 5px ">
                                                <h5>{{$documento->fecha_vencimiento}}</h5>
                                         </div>
                                          <div class=" col-sm-3"  style="margin-top: 5px ">
                                           <a  target="_blank" href="{{url('/uploads/load_files_empleados/'.$documento->nombre)}}" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-eye-open" aria-hidden="true"></i></a>
                                           <a class="btn btn-xs btn-danger"><i  class="glyphicon glyphicon-remove-circle" aria-hidden="true"></i></a>
                                         </div>
                                        </div>
                                        @endforeach
                                       
                    
                   
                    </div> 
                     @endif              
                 </div>


                 @if(count($elemento->personas)>0 || count($elemento->documentos)>0)
                 <div>
                        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Agregar Mas personas a cargo o Documentos
                        </a>
                </div>

                 <div class="col-sm-12" class="collapse" id="collapseExample" aria-expanded="false" style="height: 0; overflow: hidden;">
                 @else
                 <div class="col-sm-12">
                @endif
                    <div class="col-md-6 col-sm-12 panel panel-success" style="background: #2d2d2d; margin-top: 20px; background-clip: padding-box; border: 5px solid transparent; min-height: 400px">
                        <div style="text-align: center;"><h5>Personas a Cargo</h5></div>
                         <div class="row" style="padding: 0 2px 0 2px">
                                        <div class="row hidden-xs">
                                     
                                            <div class="col-md-5 " >
                                                <div><h5>Cedula</h5></div>
                                            </div>
                                            <div class="col-md-5 ">
                                                <div style="text-align: center;"><h5>Nombre</h5></div>
                                            </div>
                                            <div class="col-md-2 ">
                                                <div class="col-sm-1" ><h5><span  aria-hidden="true"></span></h5></div>
                                            </div>
                                        </div>
                                        
                                        <!--fila--------->
                                        <div class="row">
                                            <div class="col-md-5 " >
                                                <div class="col-sm-3" id="cedula_persona_1"><strong></strong></div>
                                            </div>
                                            <div class="col-md-5 " >
                                                <div class="col-sm-8" id="nombre_persona_1" style="text-align: center;"><strong></strong></div>
                                            </div>
                                            <div class="col-md-2 " >
                                                <div class="col-sm-1" ><a class="add_persona" data-persona="1" ><h5><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></h5></a></div>
                                            </div>
                                        
                                        </div>
                                        <!--fila--------->




                                         <!--fila--------->
                                        <div class="row">
                                            <div class="col-md-5 " >
                                                <div class="col-sm-3" id="cedula_persona_2"><strong></strong></div>
                                            </div>
                                            <div class="col-md-5 " >
                                                <div class="col-sm-8" id="nombre_persona_2" style="text-align: center;"><strong></strong></div>
                                            </div>
                                            <div class="col-md-2 " >
                                                <div class="col-sm-1" ><a class="add_persona" data-persona="2" ><h5><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></h5></a></div>
                                            </div>
                                        
                                        </div>
                                        <!--fila--------->



                                         <!--fila--------->
                                        <div class="row">
                                            <div class="col-md-5 " >
                                                <div class="col-sm-3" id="cedula_persona_3"><strong></strong></div>
                                            </div>
                                            <div class="col-md-5 " >
                                                <div class="col-sm-8" id="nombre_persona_3" style="text-align: center;"><strong></strong></div>
                                            </div>
                                            <div class="col-md-2 " >
                                                <div class="col-sm-1" ><a class="add_persona" data-persona="3" ><h5><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></h5></a></div>
                                            </div>
                                        
                                        </div>
                                        <!--fila--------->




                                         <!--fila--------->
                                        <div class="row">
                                            <div class="col-md-5 " >
                                                <div class="col-sm-3" id="cedula_persona_4"><strong></strong></div>
                                            </div>
                                            <div class="col-md-5 " >
                                                <div class="col-sm-8" id="nombre_persona_4" style="text-align: center;"><strong></strong></div>
                                            </div>
                                            <div class="col-md-2 " >
                                                <div class="col-sm-1" ><a class="add_persona" data-persona="4" ><h5><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></h5></a></div>
                                            </div>
                                        
                                        </div>
                                        <!--fila--------->



                                         <!--fila--------->
                                        <div class="row">
                                            <div class="col-md-5 " >
                                                <div class="col-sm-3" id="cedula_persona_5"><strong></strong></div>
                                            </div>
                                            <div class="col-md-5 " >
                                                <div class="col-sm-8" id="nombre_persona_5" style="text-align: center;"><strong></strong></div>
                                            </div>
                                            <div class="col-md-2 " >
                                                <div class="col-sm-1" ><a class="add_persona" data-persona="5" ><h5><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></h5></a></div>
                                            </div>
                                        
                                        </div>
                                        <!--fila--------->

                                        
                                 

                            
                         </div>
                    </div>

                    <div class="col-md-6 col-sm-12 panel panel-success" style="background: #2d2d2d; margin-top: 20px; background-clip: padding-box; border: 5px solid transparent; min-height: 400px">
                        <div style="text-align: center;"><h5>Documentos</h5></div>
                        <div class="row" style="padding: 0 2px 0 2px">
                                    <div class="row hidden-xs">
                                     
                                            <div class="col-md-5 " style="margin-left: ">
                                                <div class="col-sm-3"><h5>Docuemnto</h5></div>
                                            </div>
                                           
                                            <div class="col-md-5">
                                                <div class="col-sm-8" style="text-align: center;"><h5>Nombre</h5></div>
                                            </div>

                                            <div class=" col-md-2">
                                                <div class="col-sm-1" ><h5><span class="" aria-hidden="true"></span></h5></div>
                                            </div>

                                        
                                    
                                    </div>
                            
                                        <!--fila--------->
                                    
                                        <div class="row">
                                          <div class="col-sm-5" style="margin-top: 5px ">
                                              <div  >


                                                 <select class="form-control" id="tipo_documento_1" class="form-control" name="tipo_documento_1" >
                                                   <option value="">Selecione una opcion</option>}
                                                    @foreach($all_tipo_documento as $data)
                                                    <option value="{{$data->idtipodocumento}}">{{$data->nombre}}</option>
                                                    @endforeach
                                                </select>
                                              
                                              </div>
                                        </div>
                                          <div class="col-sm-4"  style="margin-top: 5px ">
                                                    <input class="form-control"  id="fecha_vencimiento_1" type="date" name="fecha_vencimiento_1"  >    
                                         </div>
                                          <div class=" col-sm-3"  style="margin-top: 5px ">
                                           <label class="fileContainer" style="width: 100%; text-align: center;">
                                                    Archivo
                                                    <input name="file_load_1" type="file"/>
                                            </label>
                                         </div>
                                        </div>
                                    
                                        <!--fila--------->


                                        <div class="row">
                                          <div class="col-sm-5" style="margin-top: 5px ">
                                              <div  >
                                              <select class="form-control" id="tipo_documento_2" class="form-control" name="tipo_documento_2" >
                                                  <option value="">Selecione una opcion</option>}
                                                   @foreach($all_tipo_documento as $data)
                                                    <option value="{{$data->idtipodocumento}}">{{$data->nombre}}</option>
                                                    @endforeach

                                                </select>
                                              </div>
                                        </div>
                                          <div class="col-sm-4"  style="margin-top: 5px ">
                                                    <input class="form-control"  id="fecha_vencimiento_2" type="date" name="fecha_vencimiento_2"  >    
                                         </div>
                                          <div class=" col-sm-3"  style="margin-top: 5px ">
                                           <label class="fileContainer" style="width: 100%; text-align: center;">
                                                    Archivo
                                                    <input name="file_load_2" type="file"/>
                                            </label>
                                         </div>
                                        </div>
                                    
                                        <!--fila--------->



                                        <div class="row">
                                          <div class="col-sm-5" style="margin-top: 5px ">
                                              <div  >
                                              <select class="form-control" id="tipo_documento_3" class="form-control" name="tipo_documento_3" >
                                                    <option value="">Selecione una opcion</option>}
                                                    @foreach($all_tipo_documento as $data)
                                                    <option value="{{$data->idtipodocumento}}">{{$data->nombre}}</option>
                                                    @endforeach

                                                </select>
                                              </div>
                                        </div>
                                          <div class="col-sm-4"  style="margin-top: 5px ">
                                                    <input class="form-control"  id="fecha_vencimiento_3" type="date" name="fecha_vencimiento_3"  >    
                                         </div>
                                          <div class=" col-sm-3"  style="margin-top: 5px ">
                                           <label class="fileContainer" style="width: 100%; text-align: center;">
                                                    Archivo
                                                    <input name="file_load_3" type="file"/>
                                            </label>
                                         </div>
                                        </div>
                                    
                                        <!--fila--------->



                                        <div class="row">
                                          <div class="col-sm-5" style="margin-top: 5px ">
                                              <div  >
                                              <select class="form-control" id="tipo_documento_4" class="form-control" name="tipo_documento_4" >
                                                <option value="">Selecione una opcion</option>}
                                                
                                                    @foreach($all_tipo_documento as $data)
                                                    <option value="{{$data->idtipodocumento}}">{{$data->nombre}}</option>
                                                    @endforeach
                                                </select>
                                              </div>
                                        </div>
                                          <div class="col-sm-4"  style="margin-top: 5px ">
                                                    <input class="form-control"  id="fecha_vencimiento_4" type="date" name="fecha_vencimiento_4"  >    
                                         </div>
                                          <div class=" col-sm-3"  style="margin-top: 5px ">
                                           <label class="fileContainer" style="width: 100%; text-align: center;">
                                                    Archivo
                                                    <input name="file_load_4" type="file"/>
                                            </label>
                                         </div>
                                        </div>
                                    
                                        <!--fila--------->



                                        <div class="row">
                                          <div class="col-sm-5" style="margin-top: 5px ">
                                              <div  >
                                              <select class="form-control" id="tipo_documento_5" class="form-control" name="tipo_documento_5" >
                                                    <option value="">Selecione una opcion</option>}
                                                    @foreach($all_tipo_documento as $data)
                                                    <option value="{{$data->idtipodocumento}}">{{$data->nombre}}</option>
                                                    @endforeach
                                                </select>
                                              </div>
                                        </div>
                                          <div class="col-sm-4"  style="margin-top: 5px ">
                                                    <input class="form-control"  id="fecha_vencimiento_5" type="date" name="fecha_vencimiento_5"  >    
                                         </div>
                                          <div class=" col-sm-3"  style="margin-top: 5px ">
                                           <label class="fileContainer" style="width: 100%; text-align: center;">
                                                    Archivo
                                                    <input name="file_load_5" type="file"/>
                                            </label>
                                         </div>
                                        </div>
                                    
                                        <!--fila--------->
                            
                         </div>
                    </div>                     
                 </div>

                        

                    <!---***********Campos para agregar personas-->
                        <input  id="docuemnto_a_cargo_1" type="hidden" name="docuemnto_a_cargo_1"  >
                        <input  id="nombres_a_cargo_1" type="hidden" name="nombres_a_cargo_1"  >
                        <input  id="apellidos_a_cargo_1" type="hidden" name="apellidos_a_cargo_1"  >
                        <input  id="fecha_nacimiento_a_cargo_1" type="hidden" name="fecha_nacimiento_a_cargo_1"  >
                        <input  id="genero_a_cargo_1" type="hidden" name="genero_a_cargo_1"  >
                        <input  id="tipoparentesco_a_cargo_1" type="hidden" name="tipoparentesco_a_cargo_1"  >

                        <input  id="docuemnto_a_cargo_2" type="hidden" name="docuemnto_a_cargo_2"  >
                        <input  id="nombres_a_cargo_2" type="hidden" name="nombres_a_cargo_2"  >
                        <input  id="apellidos_a_cargo_2" type="hidden" name="apellidos_a_cargo_2"  >
                        <input  id="fecha_nacimiento_a_cargo_2" type="hidden" name="fecha_nacimiento_a_cargo_2"  >
                        <input  id="genero_a_cargo_2" type="hidden" name="genero_a_cargo_2"  >
                        <input  id="tipoparentesco_a_cargo_2" type="hidden" name="tipoparentesco_a_cargo_2"  >

                        <input  id="docuemnto_a_cargo_3" type="hidden" name="docuemnto_a_cargo_3"  >
                        <input  id="nombres_a_cargo_3" type="hidden" name="nombres_a_cargo_3"  >
                        <input  id="apellidos_a_cargo_3" type="hidden" name="apellidos_a_cargo_3"  >
                        <input  id="fecha_nacimiento_a_cargo_3" type="hidden" name="fecha_nacimiento_a_cargo_3"  >
                        <input  id="genero_a_cargo_3" type="hidden" name="genero_a_cargo_3"  >
                        <input  id="tipoparentesco_a_cargo_3" type="hidden" name="tipoparentesco_a_cargo_3"  >

                        <input  id="docuemnto_a_cargo_4" type="hidden" name="docuemnto_a_cargo_4"  >
                        <input  id="nombres_a_cargo_4" type="hidden" name="nombres_a_cargo_4"  >
                        <input  id="apellidos_a_cargo_4" type="hidden" name="apellidos_a_cargo_4"  >
                        <input  id="fecha_nacimiento_a_cargo_4" type="hidden" name="fecha_nacimiento_a_cargo_4"  >
                        <input  id="genero_a_cargo_4" type="hidden" name="genero_a_cargo_4"  >
                        <input  id="tipoparentesco_a_cargo_4" type="hidden" name="tipoparentesco_a_cargo_4"  >

                        <input  id="docuemnto_a_cargo_5" type="hidden" name="docuemnto_a_cargo_5"  >
                        <input  id="nombres_a_cargo_5" type="hidden" name="nombres_a_cargo_5"  >
                        <input  id="apellidos_a_cargo_5" type="hidden" name="apellidos_a_cargo_5"  >
                        <input  id="fecha_nacimiento_a_cargo_5" type="hidden" name="fecha_nacimiento_a_cargo_5"  >
                        <input  id="genero_a_cargo_5" type="hidden" name="genero_a_cargo_5"  >
                        <input  id="tipoparentesco_a_cargo_5" type="hidden" name="tipoparentesco_a_cargo_5"  >

                       
                    <!---***********Campos para agregar personas-->





 
                        
                
                    <div class="col-sm-12" style="padding-top: 30px">
                                         @if($ruta =="Empleado_update" )
                                         <div class="col-sm-6">
                                         <input type="hidden" name="id" value="{{$id}}">
                                        <input type="submit" id="save_elemento" value="Actualizar" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Empleado')}}" class="btn col-md-10 btn-warning col-md-offset-1 "  >
                                        Volver a Inicio
                                        </a>
                                        </div>
                                       @elseif($ruta =="Empleado_create" )
                                       <div class="col-sm-6">
                                        <input type="submit" id="save_elemento" value="Crear" class="btn col-md-10 col-md-offset-1 btn-success" style="background: #a50029; color: #fff" >
                                        </div>
                                        <div class="col-sm-6">
                                        <a href="{{route('All_Empleado')}}" class="btn btn-warning col-md-10 col-md-offset-1 "  >
                                       Volver a Inicio
                                        </a>
                                        </div>
                                       @else

                                    <a href="{{ route($ruta)}}" class="btn col-md-6 col-md-offset-3" style="background: #a50029; color: #fff" >
                                        Volver a Inicio
                                    </a>
                                        @endif
                                    
                                </div>
               
                        </div>  

                        </form>
                </div>
            </div>
        </div>
    </div>
</div>








<!---********************************************---->
<!---********************************************---->
<!---**********************Modales***************---->
<!---********************************************---->
<!---********************************************---->
<!-- Modal de Personas a Cargo-->
<div class="modal fade col-md-10 col-md-offset-1" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  " role="document" style="width: 100%">
    <div class="modal-content" style="border:none" >
      <div class="modal-header" style="text-align: center;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Personas a Cargo</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12" style="margin-top: 20px">

                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="docuemnto_a_cargo">Documento</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control" id="docuemnto_a_cargo" type="number" name="docuemnto_a_cargo"  >
                    </div>
                </div>
        


            <div class="col-md-12" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="nombres_a_cargo">Nombres</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control" id="nombres_a_cargo" type="text" name="nombres_a_cargo"   >
                    </div>
                </div>
             




                <div class="col-md-12" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="apellidos_a_cargo">Apellidos</label>
                    </div>
                    <div class="col-md-6">
                        <input  class="form-control" id="apellidos_a_cargo" type="text" name="apellidos_a_cargo"  >
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px">
                    <div class="col-md-4">
                       <label class="form-control" style="border:none" for="fecha_nacimiento_a_cargo">Fecha Nacimiento</label>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control"  id="fecha_nacimiento_a_cargo" type="date" name="fecha_nacimiento_a_cargo"  >
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="genero_a_cargo"  class="col-md-4 form-control" style="border:none">Genero</label>
                             </div>

                            <div class="col-md-6">
                                <select  id="genero_a_cargo" class="form-control" name="genero_a_cargo" >
                                    <option value="1">Masculino</option>
                                    <option value="0">Femenino</option>
                                </select>
                            </div>
                 </div>

                 <div class="col-md-12" style="margin-top: 20px">
                            <div class="col-md-4">
                            <label for="tipoparentesco_a_cargo"  class="col-md-4 form-control" style="border:none">Tipo de Parentesco</label>
                             </div>

                            <div class="col-md-6">
                                <select  id="tipoparentesco_a_cargo" class="form-control" name="tipoparentesco_a_cargo" >
                                    <option value="1">Esposo(a)</option>
                                    <option value="2">Pareja</option>
                                    <option value="3">Hijo(a)</option>
                                    <option value="4">Padre o Madre</option>
                                    <option value="5">Hermano(a)</option>
                                    <option value="6">Tio(a)</option>
                                    <option value="7">Abuelo(a)</option>
                                    <option value="8">Primo(a)</option>
                                    <option value="9">Suegro(a)</option>
                                    <option value="10">Otro</option>
                                </select>
                            </div>
                 </div>


                 <div class="modal-footer">
                    <button type="button" style="margin-top: 20px" id="borrar_modal"class="btn btn-danger" data-dismiss="modal">Borrar</button>
                    <button type="button" style="margin-top: 20px" id="cerrar_modal"class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" style="margin-top: 20px" id="guardar_persona"  class="btn btn-primary">Guardar</button>
                  </div>
            </div>                 
     
      
  </div>
  </div>
</div>

@foreach($elemento->personas as $persona)


<div class="modal fade col-md-10 col-md-offset-1" id="persona_{{$persona->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  " role="document" style="width: 100%">
    <div class="modal-content" style="border:none" >
      <div class="modal-header" style="text-align: center;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Personas a Cargo</h4>
      </div>
      <div class="modal-body">
            <h5 style="color: #000 !important"><strong >Nombre:&nbsp;&nbsp;</strong> {{$persona->nombres}}&nbsp;&nbsp;{{$persona->apellidos}}</h5>
            <h5><strong>Documento:&nbsp;&nbsp;</strong> {{$persona->documento}}</h5>
            <h5><strong>Parentesco:&nbsp;&nbsp;</strong> {{$tipoparentesco[$persona->tipoparentesco]}}</h5>
            <h5><strong>Genero:&nbsp;&nbsp;</strong> {{$generos[$persona->genero]}}</h5>
            <h5><strong>Fecha Nacimiento:&nbsp;&nbsp;</strong> {{$persona->fechanacimeinto}}</h5>
     </div>                 

     <div class="modal-footer">
                    
        <button type="button" style="margin-top: 20px" id="cerrar_modal"class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    
    </div>
     
      
  </div>
  </div>
</div>
@endforeach

<!---********************************************---->
<!---********************************************---->
<!---**********************Modales***************---->
<!---********************************************---->
<!---********************************************---->
<!-- Modal -->
@endsection

@section('script')
<script >
    $(document).ready(function($) {
        var documentos =$("#documentos_div").height();
        var personas =$("#personas_div").height();
        if(documentos>personas){
                $("#personas_div").height(documentos);
        }else{
            $("#documentos_div").height(personas);
        }

        $(".add_persona").on("click", function(){

            var num_persona = $(this).attr("data-persona");
            $("#guardar_persona").attr("data-persona",num_persona);
            $("#borrar_modal").attr("data-persona",num_persona);
                        $("#docuemnto_a_cargo").val($("#docuemnto_a_cargo_"+num_persona+"").val())
                        $("#nombres_a_cargo").val($("#nombres_a_cargo_"+num_persona+"").val())
                        $("#apellidos_a_cargo").val($("#apellidos_a_cargo_"+num_persona+"").val())
                        $("#fecha_nacimiento_a_cargo").val($("#fecha_nacimiento_a_cargo_"+num_persona+"").val())
                        $("#genero_a_cargo").val($("#genero_a_cargo_"+num_persona+"").val())
                        $("#tipoparentesco_a_cargo").val($("#tipoparentesco_a_cargo_"+num_persona+"").val())
            $("#myModal").modal();
        });
        $("#guardar_persona").on("click", function(){
            var val_1 =$("#docuemnto_a_cargo").val();
            var val_2 =$("#nombres_a_cargo").val();
            var val_3 =$("#apellidos_a_cargo").val();
            var val_4 =$("#fecha_nacimiento_a_cargo").val();
            var val_5 =$("#genero_a_cargo").val();
            var val_6 =$("#tipoparentesco_a_cargo").val();
            console.log(val_1)
            console.log(val_2)
            console.log(val_3)
            console.log(val_4)
            console.log(val_5)
            console.log(val_6)

            if(val_1==="" || val_2==="" || val_3==="" || val_4==="" || val_5===""){
                alert("Ingrese Todos los datos necesario para Guardar la persona");
                return;
            }
                        var num_persona = $(this).attr("data-persona");
                        $("#docuemnto_a_cargo_"+num_persona+"").val($("#docuemnto_a_cargo").val())
                        $("#nombres_a_cargo_"+num_persona+"").val($("#nombres_a_cargo").val())
                        $("#apellidos_a_cargo_"+num_persona+"").val($("#apellidos_a_cargo").val())
                        $("#fecha_nacimiento_a_cargo_"+num_persona+"").val($("#fecha_nacimiento_a_cargo").val())
                        $("#genero_a_cargo_"+num_persona+"").val($("#genero_a_cargo").val())
                        $("#tipoparentesco_a_cargo_"+num_persona+"").val($("#tipoparentesco_a_cargo").val())


                        
                $(this).attr("data-persona","");
                $("#cedula_persona_"+num_persona+" strong").text($("#docuemnto_a_cargo").val())
                $("#nombre_persona_"+num_persona+" strong").text($("#nombres_a_cargo").val())
                $("#myModal").modal('toggle');
        })
        $("#cerrar_modal").on("click", function(){
                        $("#docuemnto_a_cargo").val("")
                        $("#nombres_a_cargo").val("")
                        $("#apellidos_a_cargo").val("")
                        $("#fecha_nacimiento_a_cargo").val("")
                        $("#genero_a_cargo").val("")
                        $("#tipoparentesco_a_cargo").val("")
                        $("#myModal").modal('toggle');
        })

         $("#borrar_modal").on("click", function(){
                         $("#docuemnto_a_cargo").val("")
                        $("#nombres_a_cargo").val("")
                        $("#apellidos_a_cargo").val("")
                        $("#fecha_nacimiento_a_cargo").val("")
                        $("#genero_a_cargo").val("")
                        $("#tipoparentesco_a_cargo").val("")
                        $("#myModal").modal('toggle');

                        var num_persona = $(this).attr("data-persona");
                        $("#docuemnto_a_cargo_"+num_persona+"").val("")
                        $("#nombres_a_cargo_"+num_persona+"").val("")
                        $("#apellidos_a_cargo_"+num_persona+"").val("")
                        $("#fecha_nacimiento_a_cargo_"+num_persona+"").val("")
                        $("#genero_a_cargo_"+num_persona+"").val("")
                        $("#tipoparentesco_a_cargo_"+num_persona+"").val("")
                        $(this).attr("data-persona","");
                        $("#cedula_persona_"+num_persona+" strong").text("")
                        $("#nombre_persona_"+num_persona+" strong").text("")
        })
        
       
            $("#idtiponomina").val("{{$elemento->idtiponomina}}");
            $("#nivelestudios").val("{{$elemento->nivelestudios}}");
            $("#idprofesion").val("{{$elemento->idprofesion}}");
            $("#rh").val("{{$elemento->rh}}");
            $("#genero").val("{{$elemento->genero}}");
            $("#liquidarpension").val("{{$elemento->liquidarpension}}");
            $("#liquidarsalud").val("{{$elemento->liquidarsalud}}");
            $("#fondo").val("{{$elemento->fondo}}");
            $("#idcargo").val("{{$elemento->idcargo}}");
            
         


           $("input#save_elemento").on("click", function(event){
            event.preventDefault();
            event.stopPropagation();
           var valor =$("#sueldo").val() ;
           var nuevo_val = valor.replace(".","").replace(".","").replace(".","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","").replace(",","");
           $("#sueldo").prop("type", "number");
           $("#sueldo").val(parseFloat(nuevo_val))
            $("#form_sueldo").submit();
            })
        
        $("#sueldo").on({
                "focus": function (event) {
                    $(event.target).select();
                },
                "focusout": function (event) {
                    $(event.target).val(function (index, value ) {
                        return value.replace(/\D/g, "")
                                    .replace(/([0-9])([0-9]{3})$/, '$1.$2')
                                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                    });
                },
                "keyup": function (event) {
                    $(event.target).val(function (index, value ) {
                        return value.replace(/\D/g, "")
                                    .replace(/([0-9])([0-9]{3})$/, '$1.$2')
                                    .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                    });
                }
        });
        
         $("#sueldo").trigger("focusout")





          $(document).on('change','input[type="file"]',function(){
                                // this.files[0].size recupera el tama単o del archivo
                                // alert(this.files[0].size);
                                
                                var fileName = this.files[0].name;
                                var fileSize = this.files[0].size;
                            
                                if(fileSize > 5000000){
                                    alert('El archivo no debe superar los 2MB');
                                    this.value = '';
                                    this.files[0].name = '';
                                }
                                  var val = $(this).val().toLowerCase();
                                    regex = new RegExp("(.*?)\.(docx|doc|pdf|jpg|jpeg|png|gif)$");

                                if (!(regex.test(val))) {
                                    $(this).val('');
                                    alert('Seleccione un Archivo de Formato Correcto');
                                    return
                                }
                                $(this).parent().css("background", "#5EF332")
    });




    });
</script>
<style type="text/css" media="screen">
label.form-control{
    background: none !important;
    color:#fff !important;
    font-weight: bolder;
    font-size: 20px;
}    

.fileContainer {
    overflow: hidden;
    position: relative;
}

.fileContainer [type=file] {
    cursor: inherit;
    display: block;
    font-size: 999px;
    filter: alpha(opacity=0);
    min-height: 100%;
    min-width: 100%;
    opacity: 0;
    position: absolute;
    right: 0;
    text-align: right;
    top: 0;
}

/* Example stylistic flourishes */

.fileContainer {
    background: #0C7FD5;
    border-radius: .5em;
    float: left;
    padding: .5em;
}

.fileContainer [type=file] {
    cursor: pointer;
}

div.main-content a
{
    border-radius: 5px !important;
}
div.col-md-4 >label{
    
}
</style>
@endsection
