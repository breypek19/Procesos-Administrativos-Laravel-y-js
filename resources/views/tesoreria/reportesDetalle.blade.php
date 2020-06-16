<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reportes ingreso</title>
    <style>
          
          body{
               font-family: sans-serif;
          }
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
                <td style="border:none; width:100%; font-size:25px; text-align:center"> 
                CENTRAL-TIERRALTA
                </td>
                </tr>
        
        <tr> 
        <td style=" border:none; margin-top:1px; font-size:27px; width:100%; text-align:center">  
        <em>  {{ $año}} </em>
        </td>
        </tr>
        </table>
        

<h2 style="color:red; text-align:center">REPORTE INGRESO DE  {{ strtoupper($rubro) . ' ' . '(' . strtoupper($detalle) . ')' }}</h2>

<br>
<br>
    <table id="report" class="table"  style="width:100%">
<thead>
            <tr>
                
                
                <th>TOTAL INGRESO</th>
                <th>MES</th>
                     
            </tr>
            
        </thead>
        <tbody>
        {{$total=0}}
        @foreach($dat as $dato)
        {{$total+=$dato->total}}
        <tr>
           
            <td>{{number_format($dato->total, 0 , ",", ".")}}</td>
            <td>{{$dato->mes}}</td>
           
        </tr>
       
         @endforeach
</tbody>
    </table>
    <br>
    <div style="background-color:yellow; width:200px; padding:5px; font-size:20px">
       <strong style="color:red">TOTAL:</strong> 
       {{number_format($total,  0 , "," , ".")}}
</div>
    </div>


</body>
</html>