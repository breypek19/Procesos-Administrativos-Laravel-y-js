<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Secretaría</title>
    <style>
          
 
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
        <td style="border:none; width:100%; font-size:25px; text-align:center"> 
        CENTRAL-TIERRALTA 
        </td>
        </tr>

<tr> 
<td style=" border:none; margin-top:1px; font-size:30px; width:100%; text-align:center">  

</td>
</tr>
</table>

<br>


<h2 style="color:red; text-align:center">Hermanos sin el Espiritu Santo</h2>
<br>
<div style="font-size:20px">
<ul>
@foreach ($persona as $item)

<li style="">{{ucwords($item->nombres . " " . $item->apellidos)}}</li>
@endforeach  
</ul>  
</div>
 
    </div>


</body>
</html>