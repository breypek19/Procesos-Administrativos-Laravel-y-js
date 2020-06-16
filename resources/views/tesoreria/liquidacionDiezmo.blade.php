<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liquidacion Diezmo</title>
    <style>
          

          body{
               font-family: sans-serif;
          }
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
  <td style="border:none; width:100%; font-size:22px; text-align:center"> 
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
         <td style="text-align:left; background-color:blue; color:white; "><strong >VALOR:<strong style="font-size: 25px">{{ " " . $valor= number_format( floatval(str_replace(".", "", $datos->bru)) -  (floatval(str_replace(".", "", $datos1->fondoL)) + floatval(str_replace(".", "", $datos1->fondoN)) + floatval(str_replace(".", "", $datos1->pastor))), 0, ",", ".")}} <strong></strong></td>
</tr>

<tr>
                <td colspan="2"><strong>POR CONCEPTO DE:</strong>    Liquidación Semanal de Diezmos</td>
                
            </tr>

            <tr>
                <td style="height:50px; color:white; font-weight: bold;" colspan="2"><strong>VALOR EN LETRAS: {{strtoupper($rubroingreso->convertirNumeroLetra(str_replace(".", "", $valor)))}}</strong>  </td>
                
            </tr>
    </table>


    <table  id="tabla2" class="table"  style="width:100%; margin-top:10px">

   


<tr>
    <td style="border:1px solid  #825C10;  text-align:center; background-color:red; color:white"><strong>DENOMINACIONES</strong></td>
    <td  colspan="2" style="border:1px solid  #825C10; text-align:center; background-color:blue; color:white"><strong>RESUMEN PARCIAL</strong></td>    
    
</tr>

<tr>
     <td style="border-right:1px solid  #825C10; text-align:center">100.000 X  {{$datos->dato1}}     =  {{number_format(100000 * intval($datos->dato1), 0 , ",", ".")}} </td>
     <td style="text-align:center">DIEZMO BRUTO      </td>
     <td ><strong>{{$bruto= $datos->bru}}</strong> </td>
   
     
</tr>


<tr>

<td  style="border-right:1px solid #825C10; text-align:center">50.000  X  {{$datos->dato2}}    = {{number_format(50000 * intval($datos->dato2), 0 , ",", ".")}}</td>
     <td style=" text-align:center">FONDO NACIONAL   {{$datos1->porcentajeN . '% '}}  </td> 
     <td> {{ $datos1->fondoN}}  </td>
</tr>


<tr>
<td  style="border-right:1px solid #825C10; text-align:center">20.000  X    {{$datos->dato3}}   =  {{number_format(20000 * intval($datos->dato3), 0 , ",", ".")}}</td>
     <td style="text-align:right">Subtotal  </td> 
<td><strong>{{number_format((floatval(str_replace(".", "", $datos->bru )) - intval(str_replace(".", "", $datos1->fondoN))),0, ",", ".")}}<strong></td>
{{$subtotal1=(floatval(str_replace(".", "", $datos->bru )) - intval(str_replace(".", "", $datos1->fondoN)))}}
</tr>


<tr>
<td  style="border-right:1px solid #825C10; text-align:center">10.000   X  {{$datos->dato4}}    =  {{number_format(10000 * intval($datos->dato4), 0 , ",", ".")}}</td>
     <td style=" text-align:center">FONDO LOCAL  {{" " . $datos1->porcentajeL . '%'}}  </td> 
     <td> {{$datos1->fondoL}}</td>
</tr>

<tr>
<td  style="border-right:1px solid  #825C10;text-align:center">5.000  X  {{$datos->dato5}}      =  {{number_format(5000 * intval($datos->dato5), 0 , ",", ".")}}</td>
     <td style="text-align:right">Subtotal  </td> 
  <td><strong>{{ number_format( $subtotal1- floatval(str_replace(".", "", $datos1->fondoL)), 0, ",", ".")}}</strong></td>
     {{  $subtotal2=( $subtotal1- floatval(str_replace(".", "", $datos1->fondoL)))}}
</tr>


<tr>
<td  style="border-right:1px solid  #825C10; text-align:center">2.000   X   {{$datos->dato6}}   = {{number_format(2000 * intval($datos->dato6), 0 , ",", ".")}}</td>
     <td style=" text-align:center">AHORO PROGRAMADO    {{$datos1->porAhorro . '%'}} </td> 
     <td>{{$datos1->pastor}} </td>
</tr>

<tr>
<td  style="border-right:1px solid  #825C10; text-align:center">1.000   X    {{$datos->dato7}}   =  {{number_format(1000 * intval($datos->dato7), 0 , ",", ".")}}</td>
     <td style="text-align:right">Subtotal </td> 
   <td><strong>{{number_format($subtotal2-floatval(str_replace(".", "", $datos1->pastor)), 0, ",", ".")}}</strong></td>
</tr>

<tr>
<td  style="border-right:1px solid  #825C10; text-align:center">monedas =  {{$datos->dato8}}</td>
     <td style="text-align: center">NETO PASTOR  </td> 
     <td><strong>{{number_format( floatval(str_replace(".", "", $datos->bru)) -  (floatval(str_replace(".", "", $datos1->fondoL)) + floatval(str_replace(".", "", $datos1->fondoN)) + floatval(str_replace(".", "", $datos1->pastor))), 0, ",", ".")}}<strong></td>
</tr>


<tr>
<td  style="border:1px solid  #825C10; text-align:center; background-color:red; color:white"><strong>DESCUENTOS VARIOS</strong></td>
     <td  colspan="2" style="border:1px solid  #825C10; text-align:center; background-color:blue; color:white"><strong>RESUMEN GENERAL<strong></td> 
     
</tr>



<tr>
<td  style="border-right:1px solid  #825C10" >FONDO NACIONAL= {{$datos1->fondoN}} </td>
     <td >DIEZMO BRUTO {{ " " . " =" }}</td> 
     <td>{{$datos->bru}}</td>
</tr>


<tr>
<td  style="border-right:1px solid  #825C10" >FONDO LOCAL =  {{$datos1->fondoL}}</td>
     <td >-DESCUENTOS {{" ="}} </td> 
     <td >{{number_format(floatval(str_replace(".", "", $datos1->fondoL)) + floatval(str_replace(".", "", $datos1->fondoN)) + floatval(str_replace(".", "", $datos1->pastor)), 0, ",", ".")}}</td> 
     {{$descuentototal= floatval(str_replace(".", "", $datos1->fondoL)) + floatval(str_replace(".", "", $datos1->fondoN)) + floatval(str_replace(".", "", $datos1->pastor))}}
</tr>

<tr>
<td  style="border-right:1px solid  #825C10"  >AHORRO= {{$datos1->pastor}}</td>     
<td>NETO PASTOR {{" ="}}  </td> 
 <td>{{$neto= (number_format(floatval(str_replace(".", "", $datos->bru )) - ($descuentototal), 0, ",", "."))}}</td>
</tr>

<tr>
<td  style="border-right: 1px  solid  #825C10"  >TOTAL DESCUENTOS= {{number_format($descuentototal, 0, ",", ".")}} </td>  
<td style="border-bottom: 1px solid  #825C10"></td>
<td style="border-bottom: 1px solid  #825C10">
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