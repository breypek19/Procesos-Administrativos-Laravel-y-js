<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Comprobante ingreso</title>
  
  <style>


body{

  
      font-family: sans-serif;
    }



      table{
border:1px  solid #825C10 ;

border-collapse: collapse;
color:#825C10;  
margin-top:-2px;
   
}

  
      

       
 table tr  td {
    border:1px solid #825C10 ; 
    padding: 4px;
    font-size:12px;
    
    
 }    
 #tabla1{
     margin-bottom:4px;
 } 
 #tabla1 #comp{
  
     text-align:center;
     font-size:24px;
     color:white;
     background-color:#1C8535   ;
     
 }

 #tabla2 td{
     color:#825C10;
     height:27px;
    
    
 }


 #tabla6   td{
    height: 100px;
   
 }

/*
 {
  
    background-image: url("ipucLogo.png");
 
  
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;

 }
*/ 


   
    </style>
</head>
<body>

<div id="contenedor">
   
<div id="t1">
    {{--
    <table style="width:40%" class="tabla" >
        <tr>
        
            <img width="150px" src="ipucLogo.png" alt="logo"/>
         
             
        
        </tr>
    </table>
--}}
    <table  style="width:30%" class="tabla" id="tabla1"> 
        
        <tr>
            <td  id="comp">Comprobante de Ingreso</td>
        </tr>
        <tr>
            <td style="color:#1B9426">No.   <strong>  {{strtoupper('  '.  '00'. $datos->id)}}  </strong>  </td>
        </tr>
        
    </table>


</div>



   <div id="t2">
   <table width="70%"  > 
        <tr>
            <td width="155"  id="ciudad">Ciudad  <strong>{{" " . ucwords("tierralta, Córdoba", "")}}</strong>  </td>
            <td style="text-align:center;  color:white; background-color: #825C10" width="60" >Fecha</td>
            <td VALIGN="TOP" style="font-size:15px" width="85">D  <strong style="font-size:20px">{{strtoupper(' ' .$datos->dia)}}</strong></td>
            <td VALIGN="TOP" style="font-size:15px" width="90" >M <strong style="font-size:20px">{{strtoupper(' '. $datos->mes)}}</strong></td>
            <td VALIGN="TOP" style="font-size:15px" width="90">A   <strong style="font-size:20px">{{strtoupper(' '. $datos->año)}}</strong></td>
</tr>

       
    </table>

    <table width="70%"  id="tabla2"> 
        <tr>
            <td width="420"     id="ciudad">Recibido de</td>
            <td style="background-color: #C2F7C7  ; color:#1B9426"   >$ <strong style="font-size:18px" >{{number_format('  '. $datos->cantidad, 0 , ",", ".")}}</strong>  </td>
           
</tr>
       
    </table>

    <table width="70%" > 
        <tr>
            <td >Dirección</td>       
</tr>
       
    </table>

    
    <table width="70%" > 
        <tr>
            <td style="background-color:#C2F7C7  ; color:#1B9426 " >La suma de (en letras)    <strong>{{" " . ucwords(  $letras   , " ")}} </strong> </td>
            
           
</tr>
       
    </table>


    <table width="70%" > 
        <tr>
            <td  >Por concepto de <strong>{{ucwords(' '. $datos->rubro, " ")}} -{{ucwords($datos->detalle, " ")}}   </strong></td>        
</tr>

       
</table>


<table width="70%" > 
        <tr>
            <td  >Cheque No.</td>  
            <td  >Banco</td>  
            <td  >Sucursal</td>  
            <td style="padding:9px">
             Efectivo
           <div style="border:1px solid; height:20px; width:28px; float:left; margin:3 10px" ></div> 
               
            </td>        
</tr>    
</table>

<table width="70%"    id="tabla6"> 
        <tr>
            
            <td style="background-color: #E9DDAD "   VALIGN="TOP"   >Codigo Ipuc.
      
        </td>  

            <td style="background-color: #E9DDAD " VALIGN="TOP"   >Cuenta
        
        </td>  

            <td style="background-color: #E9DDAD " VALIGN="TOP" >Débitos
            
        </td>  


            <td style="background-color: #E9DDAD " VALIGN="TOP" >Créditos 
     
        </td> 
   
            <td VALIGN="TOP"  style="background-color:#C2F7C7;  color:#1B9426"> Firma y sello
            <p style="margin-top:75px; text-align:center; border:1px solid "></p>
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