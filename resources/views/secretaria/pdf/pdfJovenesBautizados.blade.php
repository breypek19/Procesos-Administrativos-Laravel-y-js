<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Secretaría</title>
    <style>
          
 
          table{
border:1px  solid #825C10 ;

border-collapse: collapse;
color:black;  
   
}

table tr th{
    font-size:22px;
    padding:5px;
    background-color: brown;
    color:white;
    border:1px solid #825C10 ; 
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
        <td style="border:none; width:100%; font-size:20px; text-align:center"> 
        CENTRAL-TIERRALTA 
        </td>
        </tr>

<tr> 
<td style=" border:none; margin-top:1px; font-size:30px; width:100%; text-align:center">  

</td>
</tr>
</table>

<br>


<h2 style="color:red; text-align:center"> Listado de Jovenes Bautizados </h2>
<br>
<div style="font-size:20px">

<table style="width: 90%; margin:0 auto">
<thead>

    <tr>
        <th> Nombres</th>
        <th>Apellidos</th>
        <th>Fecha Nacim.</th>
        <th>Edad Actual</th>
             
    </tr>
    
</thead>
<tbody>

  @foreach ($persona as $item)

  <tr>
    <td>{{$item->nombres}}</td>
    <td>{{$item->apellidos}}</td>
    <td>{{$item->fecha_nacimiento}}</td>
    <td>{{$item->edad_actual}}</td>
</tr>
  @endforeach
  

</tbody>

</table>
</div>
    </div>


</body>
</html>