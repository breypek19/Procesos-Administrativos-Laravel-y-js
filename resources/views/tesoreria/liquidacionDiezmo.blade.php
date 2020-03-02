<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liquidacion Diezmo</title>
    <style>
          
      table{
border:1px  solid #825C10 ;

border-collapse: collapse;
color:black;  
   
}

#tabla2 tr td{
   border:none;
   font-size:15px;
}




          table tr  td {
    border:1px solid #825C10 ; 
    padding: 7px;
    font-size:15px;
    
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
  <td style=" border:none; margin-top:1px; font-size:30px; width:100%; text-align:center">  
  <em> Iglesia Pentecostal Unida de Colombia </em>
</td>
</tr>

<tr>
  <td style="border:none; width:100%; font-size:30px; text-align:center"> 
CENTRAL-TIERRALTA
</td>
</tr>

</table>



    <table  class="table"  style="width:100%; margin-top:10px">

     <tr>
         <td style="width:60%"><strong>CIUDAD Y FECHA:</strong>  Tierralta, {{$ultimo[0]->dia . '-' . $ultimo[0]->mes . '-' . $ultimo[0]->año}} </td>
         <td style="width:40%; text-align:left"><strong>LIQUIDACIÓN SEMANAL N°  {{'00' . $ultimo[0]->id}}</strong> </td>
</tr>

<tr>
         <td><strong>PAGADO A:</strong>  Willman Rafael Marín Parra  </td>
         <td style="text-align:left; background-color:blue; color:white; font-size:20px">VALOR: <strong >{{$valor= number_format( floatval(str_replace(".", "", $datos->bru)) -  (floatval(str_replace(".", "", $datos1->fondoL)) + floatval(str_replace(".", "", $datos1->fondoN)) + floatval(str_replace(".", "", $datos1->pastor))), 0, ",", ".")}} </strong></td>
</tr>

<tr>
                <td colspan="2"><strong>POR CONCEPTO DE:</strong>    Liquidación Semanal de Diezmos</td>
                
            </tr>

            <tr>
                <td style="height:50px" colspan="2"><strong>VALOR EN LETRAS: {{strtoupper($rubroingreso->convertirNumeroLetra(str_replace(".", "", $valor)))}}</strong>  </td>
                
            </tr>
    </table>


    <table  id="tabla2" class="table"  style="width:100%; margin-top:10px">

    <tr>
        <th colspan="2" ></th>
</tr>


<tr>
    <td style="border:1px solid; text-align:center; background-color:red; color:white">DENOMINACIONES</td>
    <td style="border:1px solid; text-align:center; background-color:blue; color:white">RESUMEN PARCIAL</td>    
</tr>

<tr>
     <td style="border-right:1px solid; text-align:center">100.000 X  {{$datos->dato1}}     =  {{number_format(100000 * intval($datos->dato1), 0 , ",", ".")}} </td>
     <td style="text-align:center">DIEZMO BRUTO:  {{$bruto= $datos->bru}}   </td>
   
     
</tr>


<tr>

<td  style="border-right:1px solid; text-align:center">50.000  X  {{$datos->dato2}}    = {{number_format(50000 * intval($datos->dato2), 0 , ",", ".")}}</td>
     <td>FONDO NACIONAL:   {{$datos1->porcentajeN . '%'}} = {{$datos1->fondoN}}  </td> 
     
</tr>


<tr>
<td  style="border-right:1px solid; text-align:center">20.000  X    {{$datos->dato3}}   =  {{number_format(20000 * intval($datos->dato3), 0 , ",", ".")}}</td>
     <td style="text-align:right">Subtotal= {{number_format((floatval(str_replace(".", "", $datos->bru )) - intval(str_replace(".", "", $datos1->fondoN))),0, ",", ".")}} </td> 
     {{$subtotal1=(floatval(str_replace(".", "", $datos->bru )) - intval(str_replace(".", "", $datos1->fondoN)))}}
</tr>


<tr>
<td  style="border-right:1px solid; text-align:center">10.000   X  {{$datos->dato4}}    =  {{number_format(10000 * intval($datos->dato4), 0 , ",", ".")}}</td>
     <td>FONDO LOCAL:  {{$datos1->porcentajeL . '%'}} = {{$datos1->fondoL}} </td> 
     
</tr>

<tr>
<td  style="border-right:1px solid;text-align:center">5.000  X  {{$datos->dato5}}      =  {{number_format(5000 * intval($datos->dato5), 0 , ",", ".")}}</td>
     <td style="text-align:right">Subtotal= {{ number_format( $subtotal1- floatval(str_replace(".", "", $datos1->fondoL)), 0, ",", ".")}} </td> 
   {{  $subtotal2=( $subtotal1- floatval(str_replace(".", "", $datos1->fondoL)))}}
</tr>


<tr>
<td  style="border-right:1px solid; text-align:center">2.000   X   {{$datos->dato6}}   = {{number_format(2000 * intval($datos->dato6), 0 , ",", ".")}}</td>
     <td>AHORO PROGRAMADO    {{$datos1->porAhorro . '%'}} =  {{$datos1->pastor}} </td> 
     
</tr>

<tr>
<td  style="border-right:1px solid; text-align:center">1.000   X    {{$datos->dato7}}   =  {{number_format(1000 * intval($datos->dato7), 0 , ",", ".")}}</td>
     <td style="text-align:right">Subtotal= {{number_format($subtotal2-floatval(str_replace(".", "", $datos1->pastor)), 0, ",", ".")}}</td> 
     
</tr>

<tr>
<td  style="border-right:1px solid; text-align:center">monedas =  {{$datos->dato8}}</td>
     <td>NETO PASTOR: {{number_format( floatval(str_replace(".", "", $datos->bru)) -  (floatval(str_replace(".", "", $datos1->fondoL)) + floatval(str_replace(".", "", $datos1->fondoN)) + floatval(str_replace(".", "", $datos1->pastor))), 0, ",", ".")}} </td> 
     
</tr>


<tr>
<td  style="border:1px solid; text-align:center; background-color:red; color:white">DESCUENTOS VARIOS</td>
     <td style="border:1px solid; text-align:center; background-color:blue; color:white">RESUMEN GENERAL</td> 
     
</tr>



<tr>
<td  style="border-right:1px solid" >FONDO NACIONAL= {{$datos1->fondoN}} </td>
     <td >DIEZMO BRUTO= {{$datos->bru}}</td> 
     
</tr>


<tr>
<td  style="border-right:1px solid" >FONDO LOCAL =  {{$datos1->fondoL}}</td>
     <td >-DESCUENTOS= {{number_format(floatval(str_replace(".", "", $datos1->fondoL)) + floatval(str_replace(".", "", $datos1->fondoN)) + floatval(str_replace(".", "", $datos1->pastor)), 0, ",", ".")}} </td> 
     {{$descuentototal= floatval(str_replace(".", "", $datos1->fondoL)) + floatval(str_replace(".", "", $datos1->fondoN)) + floatval(str_replace(".", "", $datos1->pastor))}}
</tr>

<tr>
<td  style="border-right:1px solid"  >AHORRO= {{$datos1->pastor}}</td>
     <td>NETO PASTOR= {{$neto= (number_format(floatval(str_replace(".", "", $datos->bru )) - ($descuentototal), 0, ",", "."))}} </td> 
 
</tr>

<tr>
<td  style="border-right:1px solid"  >TOTAL DESCUENTOS= {{number_format($descuentototal, 0, ",", ".")}} </td>
     <td></td> 
     
</tr>




</table>
    



<table  class="table"  style="width:100%; margin-top:20px">

     <tr>
         <td style="height:70px;width:33%"></td>
         <td style="width:33%"> </td>
         <td style="width:33%"> </td>
</tr>

<tr>
         <td  >TESORERO</td>
         <td >PASTOR </td>
         <td > VBO JUNTA LOCAL</td>
</tr>


    </table>




   
</div>
    </div>


</body>
</html>