<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reportes ingreso</title>
    <style>
          
      table{
border:1px  solid #825C10 ;

border-collapse: collapse;
color:black;  
   
}

table tr th{
    font-size:22px;
    padding:5px;
    background-color:blue;
    color:white;
}


          table tr  td {
    border:1px solid #825C10 ; 
    padding: 6px;
    font-size:20px;
    text-transform:capitalize;
    
    
 }

 table tr th, td{
     text-align:center;
 }
    </style>
</head>
<body>
    <div class="container">

<table width="100%" style="border:none">
    <tr>
        <td width="100%" style="border:none; text-align:center"> 
        <img width="150px" src="ipucLogo.png" alt="logo"/>
    </td>
    </tr>


    <tr>
        <td style="border:none; width:100%; font-size:30px; text-align:center"> 
        CENTRAL-TIERRALTA
        </td>
        </tr>

<tr> 
<td style=" border:none; margin-top:1px; font-size:30px; width:100%; text-align:center">  
<em>  {{ $anio}} </em>
</td>
</tr>
</table>






    
<br>
<h2 style="color:red; text-align:center">REPORTE EGRESO POR {{strtoupper($nombre)}}</h2>
<br>
<div>
        @if($mes!=null)
       Reporte del mes de:
        @switch($mes)
        @case("01")
            Enero
            @break
    
        @case("02")
            Febrero
            @break
         @case("03")
            Marzo
            @break
            @case("04")
            Abril
            @break
            @case("05")
            Mayo
            @break
            @case("06")
           Junio
            @break
            @case("07")
           Julio
            @break
            @case("08")
           Agosto
            @break
            @case("09")
           Septiembre
            @break
            @case("10")
           Octubre
            @break
            @case("11")
        Noviembre
            @break
            @case("12")
           Diciembre
            @break
    
      
            
    @endswitch  

          @endif
        
</div>

    <table id="report" class="table"  style="width:100%">
<thead>
            <tr>
                
                <th>DETALLE</th>
                <th>INGRESO MENSUAL</th>
                <th>MES</th>
                       
            </tr>
            
        </thead>
        <tbody>
        {{$total=0}}
        @foreach($datos as $dato)
        {{$total+=$dato->total}}
        <tr>
            <td>{{$dato->detalle}}</td>
            <td>{{number_format($dato->total, 0 , ",", ".")}}</td>
            <td>
             @switch($dato->mes)
    @case("01")
        Enero
        @break

    @case("02")
        Febrero
        @break
     @case("03")
        Marzo
        @break
        @case("04")
        Abril
        @break
        @case("05")
        Mayo
        @break
        @case("06")
       Junio
        @break
        @case("07")
       Julio
        @break
        @case("08")
       Agosto
        @break
        @case("09")
       Septiembre
        @break
        @case("10")
       Octubre
        @break
        @case("11")
    Noviembre
        @break
        @case("12")
       Diciembre
        @break

  
        
@endswitch
            
            </td>
        </tr>
       
         @endforeach
</tbody>
    </table>
    <br>
    <div style="background-color:yellow; width:200px; padding:5px; font-size:20px">
       <strong style="color:red">TOTAL:</strong> 
       {{number_format($total, 0 , ",", ".")}}
</div>
    </div>


</body>
</html>