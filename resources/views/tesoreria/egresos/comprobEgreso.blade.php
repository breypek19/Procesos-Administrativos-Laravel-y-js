<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante Egreso</title>
  
  <style>

      #contenedor{
         
      }
     
      

      table{
border:1px  solid #825C10 ;

border-collapse: collapse;
color:#825C10;  
   
}

     
      
table{
    margin-top:-1px;
}
       
 table tr  td {
    border:1px solid #825C10 ; 
    padding: 10px;
    font-size:23px;
    
 }    
 #tabla1{
     margin-bottom:4px;
 } 
 #tabla1 #comp{
  
     text-align:center;
     font-size:36px;
     color:white;
     background-color:#1C8535   ;
     
 }

 #tabla2 td{
     color:#825C10;
     height:27px;
    
    
 }


 #tabla6   td{
    height: 130px;
   
 }
 


   
    </style>
</head>
<body>

<div id="contenedor">
   
<div id="t1">
    <table  style="width:48%" class="tabla" id="tabla1"> 
        <tr>
            <td  id="comp">Comprobante de Egreso</td>
        </tr>
        <tr>
            <td style="color:#1B9426">No.   <strong>{{strtoupper('  '.  '00'. $datos->pivot->id)}}    </strong>  </td>
        </tr>
    </table>
</div>



   <div id="t2">
   <table width="100%"  > 
        <tr>
            <td width="200"  id="ciudad">Ciudad  <strong>{{ucwords(" ". " tierralta")}}</strong>  </td>
            <td style="text-align:center;  color:white; background-color: #825C10" width="60" >Fecha</td>
            <td VALIGN="TOP" style="font-size:18px" width="85">D  <strong style="font-size:29px">{{strtoupper(' ' .$datos->pivot->dia)}}</strong></td>
            <td VALIGN="TOP" style="font-size:18px" width="90" >M <strong style="font-size:29px">{{strtoupper(' ' .$datos->pivot->mes)}}</strong></td>
            <td VALIGN="TOP" style="font-size:18px" width="90">A   <strong style="font-size:29px">{{strtoupper(' ' .$datos->pivot->año)}}</strong></td>
</tr>

       
    </table>

    <table width="100%"   id="tabla2"> 
        <tr>
            <td width="540"     id="ciudad">Pagado a</td>
            <td style="background-color: #C2F7C7  ; color:#1B9426"   >$ <strong style="font-size:28px" >{{number_format('  '. $datos->pivot->cantidad, 0 , ",", ".")}}</strong>  </td>
           
</tr>
       
    </table>

    <table width="100%" > 
        <tr>
            <td >Dirección</td>       
</tr>
       
    </table>

    
    <table width="100%"  > 
        <tr>
            <td style="background-color:#C2F7C7  ; color:#1B9426 " >La suma de (en letras)    <strong> {{ucwords($letras, " ")}}</strong> </td>
            
           
</tr>
       
    </table>


    <table width="100%" > 
        <tr>
            <td  >Por concepto de <strong>{{ " " . ucwords($datos->pivot->descripcion) . " (" . ucwords($datos->nombre) . ")"}}  </strong></td>        
</tr>

       
</table>


<table width="100%" > 
        <tr>
            <td  >Cheque No.</td>  
            <td  >Banco</td>  
            <td  >Sucursal</td>  
            <td >
             Efectivo
           <div style="border:1px solid; height:20px; width:28px; float:left; margin:3 10px" ></div> 
               
            </td>        
</tr>    
</table>

<table width="100%"      id="tabla6"> 
        <tr>
            
            <td style="background-color: #E9DDAD; height:150px "   VALIGN="TOP"   >Codigo Ipuc.
      
        </td>  

            <td style="background-color: #E9DDAD " VALIGN="TOP"   >Cuenta
        
        </td>  

            <td style="background-color: #E9DDAD " VALIGN="TOP" >Débitos
            
        </td>  


            <td style="background-color: #E9DDAD " VALIGN="TOP" >Créditos 
     
        </td> 
   
            <td VALIGN="TOP"  style="background-color:#C2F7C7;  color:#1B9426"> Firma y sello del beneficiario
               <div>
                <p style="margin-top:98px; text-align:center; border:1px solid "> </p>
                  <div >
                <div style=" float:left; solid; width:26px;" > Cc.</div>
                <div  style=" float:left; margin-top:4px; margin-left:10px; border:1px solid; width:19px; height:19px" ></div>
                <div style="margin-left:10px; float:left; solid; width:26px;" > Nit.</div>
                <div  style=" float:left; margin-left:10px; margin-top:4px; border:1px solid; width:19px; height:19px" ></div>
                <div  style=" float:left; margin-left:7px; margin-top:3px;" >No.</div>
            </div>
            
        </td>        
</tr>    
</table>



   


</div>
</body>
</html>