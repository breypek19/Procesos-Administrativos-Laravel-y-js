


   

$(document).ready(function(){
    var sumtotal1=0;
$(".cantidad input, #monedas ").keypress(function(e){
    var key = window.event ? e.which : e.keyCode;
    if (key < 48 || key > 57) {
        //Usando la definición del DOM level 2, "return" NO funciona.
        e.preventDefault();
    }
});

$(".cantidad").keyup(function(){
  
    let resultado;
  let sumtotal=0;
    let cantidad;
    

    if($(this).children().val()===""){   //si el input del div .cantidad no tiene nada
     cantidad=0;
    }else{
     cantidad= parseInt($(this).children().val());               //.cantidad es el div padre del input donde va la canidad de billetes
    }

let numero= parseInt(($(this).siblings().get(0).firstElementChild.value).replace(/[.]/gi, ""));

let total= $(this).siblings().get(1).firstElementChild;
resultado=cantidad*numero;

total.value=formatNumber.new(resultado);

 $(".total input").each(function(){
     if($(this).val()==="")$(this).val(0);
    sumtotal+=parseInt(($(this).val()).replace(/[.]/gi, ""));
    
 });
    sumtotal1=sumtotal;  
 
$("#sum-total").val(formatNumber.new(sumtotal + parseInt($("#monedas").val())) );  //la suma del total de todos los div .total se lo asigno al inpu total bruto
   
limpiar();
descuentos($("#porcentajeNac").val(), $("#fondoN"), $("#fondoL"), $("#ahorro"),$("#subtotal1") );
descuentos($("#porcentajeLocal").val(), $("#fondoL"), $("#fondoN"),$("#ahorro"), $("#subtotal2") );
descuentos($("#porcenAhorro").val(), $("#ahorro"), $("#fondoN"), $("#fondoL"),$("#subtotal3") );


});


$("#monedas").keyup(function(){
    let valor;
    if($(this).val()==""){
   valor=0;
    }else{
      valor=  $(this).val() ;
    }

$("#sum-total").val(formatNumber.new(sumtotal1+ parseInt(valor)));
limpiar();
            //porcentaje                //descuento,   otro1        otro2        subtotal
descuentos($("#porcentajeNac").val(), $("#fondoN"), $("#fondoL"), $("#ahorro"),$("#subtotal1") );
descuentos($("#porcentajeLocal").val(), $("#fondoL"), $("#fondoN"),$("#ahorro"), $("#subtotal2") );
descuentos($("#porcenAhorro").val(), $("#ahorro"), $("#fondoN"), $("#fondoL"),$("#subtotal3") );

});




$("#porcentajeNac").keyup(function(){
let porcentaje=$(this).val();
descuentos(porcentaje, $("#fondoN"), $("#fondoL"),$("#ahorro"), $("#subtotal1") )
});



$("#porcentajeLocal").keyup(function(){
    let porcentaje=$(this).val();
    descuentos(porcentaje, $("#fondoL"),$("#fondoN"),$("#ahorro"),$("#subtotal2"))
    });


    $("#porcenAhorro").keyup(function(){
        let porcentaje=$(this).val();
    
        descuentos(porcentaje, $("#ahorro"),$("#fondoN"), $("#fondoL"), $("#subtotal3"))
        });
    

   //para el formulario de ingreso de diezmo, cuando escribo en el campo detalle, que me traiga por ajax el detalle que corresponda
        $("#detalle").keyup (function(event){
   
            let codigo = event.which || event.keyCode;
        
            if(codigo === 8){   //codigo 8 corrresponde a la tecla borrar
              return;
            }
        
            let id_detalle=$("#id_detalle");
        let cadena= $("#detalle").val();
        
        
        if(cadena.length===0){
             $(this).val("");
             id_detalle.val("");
             cadena="";
            return;
        }
           //arreglar: como hacer para evitar que modifiquen los atributos html, los id, el valor del input type hidden, etc..
                     
                  $.get('/tesor/ingresos/detalleDiezmo/'+ cadena ,
        function( data, textStatus, jQxhr ){ 
          let obj=data.detalle;
           if(obj){
         //  console.log(obj);
         $("#detalle").val(obj.nombre); 
        $("#id_detalle").val(obj.id);
           
            }
            
        },
        'json'
        )
        .fail(function( xhr, textStatus, errorThrown ){
        //consol
        
        });
        
        });


        $("#liquidar").click(function(){
             liquidar();
        });



});


function descuentos(porcentaje, descuento, otro,otro1, total1){
   let total= $("#sum-total").val().replace(/[.]/gi, "");
let otr=otro.val().replace(/[.]/gi, "");
let otr2=otro1.val().replace(/[.]/gi, "");


    if(total.length==0 || porcentaje==="" ) {
    descuento.val("0");  //el descuento de ese fondo es 0
    total1.val("0");     //el subtotal de ese fondo es 0
  $("#neto").val(formatNumber.new( parseInt(total)-(parseInt(otr)+ parseInt(otr2))));  
    return;
    }
     
  
    let fondo;
    let subtotal;
 

     if(otr.length==0){
         fondo=parseInt(total) *((parsInt(porcentaje)/100));
         subtotal=parseInt(total)-parseInt(fondo);
     }else{
         fond=parseInt(otr)+ parseInt(otr2);
      fondo=parseInt((parseInt(total) - fond) * (parseInt(porcentaje)/100));
      subtotal=parseInt(parseInt(total)- (fond  + parseInt(fondo)));
     }
    
 total1.val(formatNumber.new(subtotal));
descuento.val(formatNumber.new(fondo));
$("#cantidad").val(total);  //inpu type text para el diezmo bruto
$("#cantidadNeto").val(subtotal);//type hidden para el diezmo neto
let desc= descuento.val().replace(/[.]/gi, "");

if(otr.length===0 ){
   $("#neto").val(formatNumber.new(parseInt(total) - ((parseInt(desc) + 0))));

}else{
    $("#neto").val( formatNumber.new(subtotal));
}
}
//cuando se ejecute...debo ingresar a la base de datos el diezmo bruto, y egresar el diezmo neto

function limpiar(){
    $("#fondoL").val(0);
    $("#fondoN").val(0);
    $("#ahorro").val(0);
 
    
}


function liquidar(){
let cien=$("#cien").val();
let cincuenta=$("#cincuenta").val();
let veinte=$("#veinte").val();
let diez=$("#diez").val();
let cinco=$("#cinco").val();
let dos=$("#dos").val();
let mil=$("#mil").val();
let monedas= $("#monedas").val();
let bruto=$("#sum-total").val();
let porcentajeNacional= $("#porcentajeNac").val();
let fondoNacional= $("#fondoN").val();
let porcentajeLocal= $("#porcentajeLocal").val();
let fondoLocal= $("#fondoL").val();

let porcenAhorro= $("#porcenAhorro").val();
let ahorroT= $("#ahorro").val();
let cadena= JSON.stringify({dato1:cien, dato2:cincuenta, dato3: veinte, dato4: diez, 
    dato5:cinco,  dato6: dos, dato7:mil, dato8:monedas, bru:bruto
});

let cadena1= JSON.stringify({
    porcentajeN:porcentajeNacional, fondoN:fondoNacional, porcentajeL:porcentajeLocal, fondoL:fondoLocal,
    pastor:ahorroT,porAhorro:porcenAhorro

});

//de aqui para arriba son los datos que envio al pdf, a la ruta donde esta el controlador para que retorne el pdf


let neto= $("#cantidadNeto").val(); //type hidden que tiene lo que le pasa el campo del diezmo neto que esta arriba del formulario
let id_rubro=$("#rubro").val();
let nombre_detalle= $("#detalle").val();
let id_detalle= $("#id_detalle").val();
let cantidad= $("#cantidad").val();   //input que tiene lo que se le pasa de diezmo bruto, osea que cantidad tiene el diezmo bruto
let fecha= $("#fecha").val();
let comentario= $("#comentario").val();


if(!validar.vacio(id_rubro, nombre_detalle, id_detalle, cantidad, fecha, bruto, neto )){
    alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
      alertify.notify("Hay campos vacios",'error',2, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 	
    return;
}

let arr= fecha.split("-");
let [anof, mesf, diaf] = arr;

$.post('/tesor/ingresos/diezmoGeneral',
      {
         rubro:id_rubro, detalle:id_detalle, cantid:cantidad, ano:anof,
         mes:mesf, dia:diaf, coment:comentario, net:neto
         },

     function( data, textStatus, jQxhr ){       

        //eliminar datos del formulario
        //revizar el id_detalle cuando cambia la busqueda en el campo de talle
        //buscar registro en table pivot por id primaria para mostrar esos datos en el pdf

        $("#rubro").val("");
 $("#detalle").val("");
 $("#id_detalle").val("");
 $("#cantidad").val("");
 $("#fecha").val("");
 $("#comentario").val("");

 window.open("http://127.0.0.1:8000/tesor/movimientos/reportes/liquidardiezmo/" + cadena + '/' + 
 cadena1, 'liquidacion','width=900,height=750, toolbar=no,scrollbars=no,location=no,resizable =yes');
 window.moveTo(0,0);
 window.resizeTo(screen.width,screen.height-100);
 

  
          
   }, 
    
 )
     .fail(function( xhr, textStatus, errorThrown ){
console.log(xhr) ;
console.log(textStatus);
console.log(errorThrown);

     });







}