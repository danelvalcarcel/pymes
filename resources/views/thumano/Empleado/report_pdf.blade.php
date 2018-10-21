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
        <h1>Reporte de Empleados</h1>
    </div>
    <div style="width: 100%">
                            <table class="table " style="margin-top: 30px; width: 100%">
                        <thead>
                            <tr>
                            <td>#</td>
                            <td>Doc</td>
                            <td>Fecha Ingreso</td>
                            <td>Nombre</td>
                            <td>Cargo</td>
                            <td>Centro</td>
                            <td>Sueldo</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empleados as $empleado)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$empleado->documento}}</td>
                            <td>{{$empleado->fecha_ingreso}}</td>
                            
                            <td>{{$empleado->nombres}}</td>
                            <td>{{$empleado->Cargo->nombre}}</td>
                            <td>{{$empleado->Centro_trabajo->nombre}}</td>
                            <td>{{number_format($empleado->sueldo, 0, ',', '.')}}</td>
                            </tr>
                        @endforeach
                           
                        </tbody>
                        <tfoot>
                         
                        </tfoot>

               
                </table>
    </div>
</body>
</html>

