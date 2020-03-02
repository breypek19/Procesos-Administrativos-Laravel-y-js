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
    padding: 7px;
    font-size:20px;
    
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
        <td style="border:none; width:100%; font-size:27px; text-align:center"> 
        Central Tierralta, {{$año}}
        </td>
        </tr>
</table>



<br>

<h2  style="color:red; margin:10px; text-align:center">INFORME GENERAL {{strtoupper($nombre)}}</h2>

<br>
<div>
    <div style="text-align:center; font-size:30px" >Ingreso</div>
    <table id="report" class="table"  style="width:100%">
<thead>
    
            <tr>
                <th>RUBRO</th>
                 <th>DETALLE</th>
                <th> INGRESO MENSUAL</th>
                
                       
            </tr>
            
        </thead>

        <tbody>
        {{$total=0}}
        @foreach($dat as $datos)
        {{$total+=$datos->total}}
        <tr>
           <td>{{ucwords($datos->rubro, " ")}}</td>
           <td>{{ucwords($datos->detalle, " ")}}</td>
            <td>{{"$" . number_format($datos->total, 0, ",", ".")}}</td>
          
        </tr>
       
         @endforeach
</tbody>
       

    </table>
    
   <table width="100%" style="margin-top: -2px">
       <tr>
           <td  width="57%">Total Ingreso</td>
           <td style="background-color:gold" width="42%"> {{"$" . number_format($total,  0, "," , ".")}}</td>
       </tr>
   </table>

</div>
    

<br>
<br>
<br>



<div>
    <div style="text-align:center; font-size:30px" >Egreso</div>
<table id="reportEgreso" class="table"  style="width:100%">
    <thead>
                <tr>
                    <th>RUBRO</th>
                     <th>DETALLE</th>
                    <th> INGRESO MENSUAL</th>
                    
                           
                </tr>
                
            </thead>
    
            <tbody>
            {{$total1=0}}
            @foreach($datEgreso as $datoEg)
            {{$total1+=$datoEg->total}}
            <tr>
               <td>{{ucwords($datoEg->rubro, " ")}}</td>
               <td>{{ucwords($datoEg->detalle, " ")}}</td>
                <td>{{"$". number_format($datoEg->total, 0 , ",", ".")}}</td>
              
            </tr>
           
             @endforeach
    </tbody>
           
    
        </table>

 
        <table width="100%" style="margin-top: -2px">
            <tr>
                <td  width="57%">Total Egreso</td>
                <td style="background-color:gold;" width="42%"> {{"$". number_format($total1,  0 , "," , ".")}}</td>
            </tr>
        </table>
</div>


<br>
<br>
<table width="100%" style="margin-top: -2px">
    <tr>
        <td  width="57%"> @if($total>$total1)
            Excedente:
            @elseif($total<$total1)
              Deficit:
       
              @else
              Total:
           @endif</td>
        <td style="background-color:red; color:seashell" width="42%"> {{"$". number_format($total-$total1, 0, ",", ".")}}</td>
    </tr>
</table>

    </div>

</body>
</html>