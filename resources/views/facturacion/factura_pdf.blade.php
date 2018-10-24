<!DOCTYPE html>
<html lang="en">
<style type="text/css">
    table tr td{
        border: 1px solid #000;
    }
    table tr{
        border: 1px solid #000;
    }
    table thead tr td{
        font-weight: bold
    }
</style>
<body style="padding: 60px 20px 10px 20px">
    <div style="width: 100%">
        <div style="width: 30%; float: left;">
            <img src="{{url('/uploads/load_files_incapacidades/'.$user->Entidad->logo)}}" width="150px" height="100px"> 
           <h4> {{$user->Entidad->nit}} {{$user->Entidad->regimen}} </h4>
        </div>
        <div style="width: 50%; float: left;">
            <p>{{$user->Entidad->nombre}} </p>
            <p>{{$user->Entidad->direccion}} </p>
            <p>Email: {{$user->Entidad->email}} </p>
            <p>Contacto: {{$user->Entidad->celular}} </p>
        </div>
        <div style="width: 20%; float: left;">
            <p>Factura de Venta</p>
            <p>Nº {{$operacion->consecutivo}}</p>
        </div>
        
    </div>
    <div style="width: 100%">
        <table style="width: 100%">
            <tbody>
                <tr>
                    <td>Informacion del Cliente</td>
                    <td>Fecha</td>
                    <td>Total</td>
                </tr>
                <tr >
                    <td rowspan="3" >
                    <p>{{$operacion->cliente->firts_name}} {{$operacion->cliente->last_name}} </p>
                    <p><strong>Direccion:</strong> {{$operacion->cliente->direccion}}</p>
                    <p><strong>Telefono:</strong> {{$operacion->cliente->celular_1}}</p>
                    </td>
                     <td style="height: 100%">
                    <td style="height: 100%">
                        {{number_format($operacion->total,2)}}</td>
                </tr>
                <tr>
                    <td>
                        Forma De Pago
                        <p>Contado</p>
                    </td>
                    <td>
                        Vendedor
                    </td>
                </tr>
                <tr>
                    <td>Fecha Vencimiento</td>
                    <td>Referencia</td>
                </tr>
            </tbody>
        </table>
        
    </div>

                                        <div  style="width: 100%; margin-top: 30px">

                                                                <table style="width: 100%">
                                                                    <thead >
                                                                    <tr>
                                                                        <th >Codigo</th>
                                                                        <th >Nombre</th>
                                                                        <th >Cant</th>
                                                                        <th >Precio</th>
                                                                        <th >Iva </th>
                                                                        <th >Desct</th>

                                                                        <th >Total</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    @foreach($operacion->inventarios as $inventario)

                                                                        <tr data-id_inv="{{$inventario->id}}" id="{{$inventario->codigo}}">
                                                                            <td id="codigo">{{$inventario->codigo}}</td>
                                                                            <td id="nombre">{{$inventario->producto->nombre}}</td>
                                                                            <td id="cantidad" data-max_canti="{{$inventario->cantidad }}">{{number_format($inventario->pivot->cantidad_inv,0)}}</td>
                                                                            <td id="precio_prod">{{number_format( $inventario->producto->precio_venta,2)}}</td>
                                                                            
                                                                            <td>19%</td>
                                                                            <td id="descuento_aplicado" data-descuento="{{$inventario->pivot->descuento}}">{{$inventario->pivot->descuento}}%</td>
                                                                            <td data-descuento="{{$inventario->pivot->descuento}}" id="total">
                                                                                <div class="row">
                                                                                    <div class="col-md-9" style="padding-right: 0" id="total_val">{{number_format( $inventario->pivot->dinero,2)}}</div>
                     
                                                                                </div>
                                                                            </td>

                                                            </tr>
                                                                  @endforeach






                                                                    </tbody>
                                                                </table>

                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <h5>Base</h5>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <h5><strong>$ </strong><strong id="base_factura">{{number_format((($operacion->total)/(1.19)),2)}}</strong></h5>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <h5>Impuesto</h5>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <h5><strong>$ </strong><strong id="impuesto_factura">{{number_format(((($operacion->total)/(1.19))*(0.19)),2) }}</strong></h5>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <h5>Total</h5>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <h5><strong>$ </strong><strong id="total_factura">{{number_format($operacion->total,2)}}</strong></h5>
                                                                </div>
                                                            </div>
                                                            <div style="width: 100%">
                                                                <p><strong>Valor en Letras:</strong> {{$letras_total}}</p>
                                                                </div>


                                                                <div style="width: 100%">
                                                                <p><strong>Observaciones:</strong></p>
                                                                </div>
                                          

                                    
 
</body>
</html>
