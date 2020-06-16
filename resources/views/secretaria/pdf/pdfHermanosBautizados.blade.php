<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Secretaría</title>
   

    <!-- Styles -->
  
    <style>
        
          
          body{
               font-family: sans-serif;
               
          }


          .table{
          width: 90%;
          margin:0 auto;
            border:1px  solid  ;
            
            border-collapse: collapse;
  }

  table tr th{
    font-size:22px;
    padding:2px;
    
}

table tr  td, table tr th {
    border:1px solid  ; 
    padding: 7px;
    font-size:22px;
}

    ul li{
        padding:4px;
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


</table>



<h2 style="color:red; text-align:center">Miembros Ipuc Central Tierralta</h2>
<br>
<div style="font-size:25px">
    
    <table class="table">
        {{$cant=0}}
        <thead style="font-size: 25px">
          <tr>
            <th style="text-align: center" scope="col">#</th>
            <th style="text-align: center" scope="col">Nombre Completo</th>
          </tr>
        </thead>
        <tbody>
         
            @foreach ($person as $item)

            
      <tr>
      <th style="text-align: center" scope="row">{{$cant+=1}}</th>
        <td>{{ucwords($item->nombres . " " . $item->apellidos)}}</td> 
      </tr>

@endforeach  
         
        </tbody>
      </table>

     
 
</div>
 
    </div>


</body>
</html>