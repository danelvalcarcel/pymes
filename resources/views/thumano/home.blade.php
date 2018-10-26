
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
                <div class="panel-heading">Talento Humano</div>


                <div class="panel-body">
                @if(count($Incapacidades)>0)
                    <div><h2>Incapacidades Por Revisar</h2></div>

                        <div class="alert alert-danger"  role="alert" style="background: #fff">
                        <ul>
                      @foreach ($Incapacidades as $Incapacidade)
                                <li>Incapacidad por revisar de {{$Incapacidade->empleado->nombres}}  {{$Incapacidade->empleado->apellidos}}
                                {{$Incapacidade->empleado->Cargo->nombre}} de Sede  {{$Incapacidade->empleado->Centro_trabajo->nombre}}</li>
                         @endforeach
                        </ul>
                        </div>
                        @endif
                
                     @if(count($Licencias)>0)
                    <div><h2>Licencias Por Revisar</h2></div>

                        <div class="alert alert-danger bg-primary"  role="alert" style="background-color: #337ab7; color: #fff">
                        <ul>
                         @foreach ($Licencias as $Licencia)
                                <li>Licencias por revisar de {{$Licencia->empleado->nombres}}  {{$Licencia->empleado->apellidos}}
                                {{$Licencia->empleado->Cargo->nombre}} de Sede  {{$Licencia->empleado->Centro_trabajo->nombre}}</li>
                         @endforeach
                        </ul>
                        </div>
                        @endif

                                   @if(count($Vacaciones)>0)
                    <div><h2>Vacaciones Por Revisar</h2></div>

                        <div class="alert alert-danger bg-success"  role="alert" style="background-color: #87B87F; color: #fff">
                        <ul>
                          @foreach ($Vacaciones as $Vacacione)
                                <li>Vacaciones por revisar de {{$Vacacione->empleado->nombres}}  {{$Vacacione->empleado->apellidos}}
                                {{$Vacacione->empleado->Cargo->nombre}} de Sede  {{$Vacacione->empleado->Centro_trabajo->nombre}}</li>
                         @endforeach
                        </ul>
                        </div>
                        @endif
                         <div class="col-sm-12" id="grafico_1" class="grafico_1" style="padding-bottom: 20px; display: block;">
                    
                         </div>
              
                </div>
                                       
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<script>
    $(document).ready(function($) {
        
        @php 
            $suma=0;
            $total=0;
         
        @endphp

        @foreach ($centros_trabajos as $centros_trabajo)
        @php 
              $total = $total + count($centros_trabajo->empleado); 
        @endphp
        @endforeach
         @php 
            if($total==0){
                $total=1;
            } 
        @endphp

    Highcharts.chart('grafico_1', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Empleados por Centro'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [

                      @foreach ($centros_trabajos as $centros_trabajo)
                        
                      {                    
                       name:"{{$centros_trabajo->nombre}}",
                   
                    y: {{count($centros_trabajo->empleado)/$total}},
                  sliced: true,
                  selected: true
                  },
                                 
                    
                    @endforeach
                    
 
        
        ]
    }]
});
    
    
    
    
    
    
    
    
    


    });

</script>
@endsection

