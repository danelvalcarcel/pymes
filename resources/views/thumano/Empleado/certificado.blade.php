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
    <div style="width: 100%; text-align: center;">
        <h1>Certificado Laboral</h1>
    </div>
    <div style="width: 100%; margin-top: 100px">
       <h2 style="text-align: center;">{{$user->Entidad->nombre}}</h2>    

       <p style="margin-top: 120px">Certifica que <strong> {{$user->nombres}}&nbsp;{{$user->apellidos}}</strong> labora en nuestra empresa como <strong>{{$user->Cargo->nombre}}</strong>, 
        desde el<strong> {{$user->fecha_ingreso}}</strong> devengando un sueldo mensual de
<strong>${{number_format($user->sueldo, 0, ',', '.')}}</strong></p> 
        <p style="margin-top: 120px">Atentamente</p>                

        <p style="margin-top: 40px">
            <h3 style="margin:0; padding: 0">{{$user->Entidad->nombre_representante}}</h3>
            <h4 style="margin:0; padding: 0">{{$user->Entidad->cargo}}</h4>
        </p>


        <p style="margin-top: 40px">Dirección:&nbsp;<strong>{{$user->Entidad->direccion}}</strong><br>
            Telefono:&nbsp;<strong>{{$user->Entidad->telefono}}</strong>
        </p>
    </div>
</body>
</html>

