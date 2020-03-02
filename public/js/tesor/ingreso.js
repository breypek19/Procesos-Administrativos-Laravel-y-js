





function crearRubro(){

const  dato= $("#rubro_solo").val();

    $.post('/tesor/ingresos',
       {nom:dato},
        function( data, textStatus, jQxhr ){        
     alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
      alertify.notify(data.mensaje,'Exito',1, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 		  
            $("#rubro_solo").val("");
            $("#rubro").append('<option value="'+data.row.id+'">'+ data.row.nombre.toUpperCase()+'</option>');
         //  setTimeout(function() {
           //    let pagina= window.location.href;  //url actual
             //    window.location.replace(pagina); 
              //}, 300);  
      },
        'json'
    )
        .fail(function( xhr, textStatus, errorThrown ){

              let cadena="";
              $.each(xhr.responseJSON.errors, function (ind, elem) { 
                cadena+=elem  
               });

          let alert = alertify.alert("Error", cadena).set('label', 'Aceptar') ;    	 
    alert.set({transition:'slide'}); 
    alert.set('modal', true);  

        });

}   



function crearDetalle(detalle){

   
    
        $.post('/tesor/ingresos/detalle',
           {detall:detalle},
            function( data, textStatus, jQxhr ){        
         alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
          alertify.notify(data.mensaje,'Exito',1, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 		  
         $("#detalle_d").val("");
          },
            'json'
        )
            .fail(function( xhr, textStatus, errorThrown ){
                let cadena="";
                $.each(xhr.responseJSON.errors, function (ind, elem) { 
                  cadena+=elem  
                 });
  
            let alert = alertify.alert("Error", cadena).set('label', 'Aceptar') ;    	 
      alert.set({transition:'slide'}); 
      alert.set('modal', true);  
    
            });
    
    }   
    


     


  function  crear_ingreso(dato1, dato2,dato3,dato4,dato5,dato6,dato7){
 
    $.post('/tesor/ingresos/general',
      {
         rubro:dato1, detalle:dato2, cantid:dato3, ano:dato4,
         mes:dato5, dia:dato6, coment:dato7
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
 //  console.log(data.dato);     
  window.open("http://127.0.0.1:8000/tesor/comprobante/ingreso/" + data.dato); //hago esto para abrir el pdf en otra pestaña
          
   },
     'json'
 )
     .fail(function( xhr, textStatus, errorThrown ){
console.log(xhr) ;
console.log(textStatus);
console.log(errorThrown);

     });

    }



$(document).ready(function(){
  $(".card").hide();

//al escribir en campo detalle, me traiga el nombre del que coincida, junto con el id que se guardara en 
//input type hidden
$("#detalle").keyup (function(event){
  $("#id_detalle").val("");

   
let cadena= $(this).val();


if(cadena===""){
     $(".listaDet").remove();
    return;
}
   //arreglar: como hacer para evitar que modifiquen los atributos html, los id, el valor del input type hidden, etc..
             
          $.get('/tesor/ingresos/'+ cadena ,
function( data, textStatus, jQxhr ){ 
  let obj=data.detalle;
   if(obj.length>0){
 $(".listaDet").remove();
 $(".card").show();
if (!$(".listaDetalles .card  .cabe").length){
  $(".listaDetalles .card").append("<div class='card-header cabe'>" + "Selecciona un Detalle:" + "</div>")
  $(".listaDetalles .card").append("<ul class='list-group list-group-flush'></div>")
   
    }

    $.each(obj, function (ind, elem) { 
      $(".listaDetalles .card ul").append("<li class='list-group-item listaDet'  id=" + elem.id +  ">" +elem.nombre +"</li>")
     });


    }else{
      $(".listaDet").remove();
    }
    
},
'json'
)
.fail(function( xhr, textStatus, errorThrown ){
//consol

});

});



$(document).on("click", ".listaDet", function(){
  let id= $(this).attr("id"); //me traigo el valor del id de ese detalle que esta en el atributo id
     let nombre= $(this).text(); //me traigo el texto
    
     $("#id_detalle").val(id);  //le pongo el valor de id al campo hidden de id_detalle
     $("#detalle").val(nombre); //le pongo el nombre al campo de Detalle rubro
     alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
          alertify.notify("Ha seleccionado: " +nombre  ,'Exito',2, null);

          $(this).remove();//elimino de la lista ese que selecciono

          if($(".listaDet").length===0)  $(".card").hide(); //si al eliminar ese no hya mas opciones en la lista, oculto el div con clase card
})


//valido que sean solo numeros en input cantidad
$("#cantidad").keypress(function(event){

   return valideKey(event);
});

//guardar rubro
$("#rubroGuardar").click(function(){

const rub=$("#rubro_solo").val();

if(!validar.vacio(rub)){

    
    let alert = alertify.alert("Error", "El campo esta vacio").set('label', 'Aceptar') ;    	 
    alert.set({transition:'slide'}); 
    alert.set('modal', true);  	
    return;
}

if(!validar.longitud(rub,3)){
    
    let alert = alertify.alert("Error", "El dato es muy corto").set('label', 'Aceptar') ;    	 
    alert.set({transition:'fade'}); 
    alert.set('modal', true);  	
    return;
}

crearRubro();

});


//guardar detalle

$("#detalle_guardar").click(function(){

let detalle= $("#detalle_d").val();



if(!validar.vacio(detalle)){
    alertify.set('notifier','position', 'bottom-right'); //top-left, top-right, bootom-left, bottom-right
      alertify.notify("Hay campos vacios",'error',1, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 		 
    return;
} 

if(!validar.longitud(detalle, 3)){
    alertify.set('notifier','position', 'bottom-right'); //top-left, top-right, bootom-left, bottom-right
    alertify.notify("Detalle muy corto",'error',1, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 		 
  return;  
}


crearDetalle(detalle);

});



//guardar ingreso general

$("#ingreso_general").click(function(e){

let id_rubro=$("#rubro").val();
let nombre_detalle= $("#detalle").val();
let id_detalle= $("#id_detalle").val();
let cantidad= $("#cantidad").val();
let fecha= $("#fecha").val();
let comentario= $("#comentario").val();

if(!validar.vacio(id_rubro, nombre_detalle, id_detalle, cantidad, fecha)){
    alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
      alertify.notify("Hay campos vacios",'error',2, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 	
    return;
}
 
let arr= fecha.split("-");
let [ano, mes, dia] = arr;
 
crear_ingreso(id_rubro, id_detalle, cantidad, ano, mes, dia, comentario);

});




});