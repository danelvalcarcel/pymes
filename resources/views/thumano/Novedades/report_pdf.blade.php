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
        <h1>Reporte de novedades</h1>
    </div>
    <div style="width: 100%">
                            <table class="table " style="margin-top: 30px; width: 100%">
                        <thead>
                            <tr>
                            <td>#</td>
                            <td>Doc</td>
                            <td>Nombre</td>
                            <td>Fecha</td>
                            <td>Centro</td>
                            <td>Cargo</td>
                            <td>Tipo</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($novedades as $novedade)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$novedade->empleado->documento}}</td>
                            <td>{{$novedade->empleado->nombres}}  {{$novedade->empleado->apellidos}}</td>
                            <td>{{$novedade->fecha_desde}}</td>
                            <td>{{$novedade->empleado->Centro_trabajo->nombre}}</td>
                              <td>{{$novedade->empleado->Cargo->nombre}}</td>
                            <td>{{$tipos[$novedade->forma]}}</td>
                            </tr>
                        @endforeach
                           
                        </tbody>
                        <tfoot>
                         
                        </tfoot>

               
                </table>
    </div>
</body>
</html>

