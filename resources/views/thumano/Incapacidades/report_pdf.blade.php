<!DOCTYPE html>
<html lang="en">
<style type="text/css">
    table tr td{
        
        border-right: 1px solid #000;
        border-top: 1px solid #000;
    }
    table tr{
        border: 1px solid #000;
    }
    table thead tr td{
        font-weight: bold
    }
    table{
        border-bottom: 1px solid #000;
    }
</style>
<body>
    <div style="width: 100%; text-align: center;">
        <h1>Reporte de incapacidades</h1>
    </div>
    <div style="width: 100%">
                            <table class="table " style="margin-top: 30px; width: 100%">
                        <thead>
                            <tr>
                            <td>#</td>
                            <td>Doc</td>
                            <td>Nombre</td>
                            <td>Fecha Desde</td>
                            <td>Fecha Hasta</td>
                            <td>Centro</td>
                            <td>Cargo</td>
                            <td>Motivo</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($incapacidades as $incapacidade)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$incapacidade->empleado->documento}}</td>
                            <td>{{$incapacidade->empleado->nombres}}  {{$incapacidade->empleado->apellidos}}</td>
                            <td>{{$incapacidade->fecha_desde}}</td>
                            <td>{{$incapacidade->fecha_hasta}}</td>
                            <td>{{$incapacidade->empleado->Centro_trabajo->nombre}}</td>
                              <td>{{$incapacidade->empleado->Cargo->nombre}}</td>
                            <td>{{$incapacidade->Enfermedad->nombre}}</td>
                            </tr>
                        @endforeach
                           
                        </tbody>
                        <tfoot>
                         
                        </tfoot>

               
                </table>
    </div>
</body>
</html>

