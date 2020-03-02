





function crearDetalle(dato){

    if(!validar.vacio(dato)){   //calidar es un objeto que tiene una funcion vacio, que se encuentra en el archivo general.js
    
  let alert = alertify.alert("Error", "El campo esta vacio").set('label', 'Aceptar') ;    	 
  alert.set({transition:'slide'}); 
  alert.set('modal', true);  	
  return;
    } 
    
    $.post("/tesor/egresos/Detalle", 
    {nombreDetalle:dato},

    function(data){
      
      alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
      alertify.notify(data.mensaje,'Exito',1, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 		  
            $("#detalleE").val("");
            $("#detalleE").focus();
       
    },
    'json'
    ).fail(function(fallo){
   //console.log(fallo.responseJSON);
            let cadena="";
            $.each(fallo.responseJSON.errors, function (ind, elem) { 
              cadena+=elem  
             });

             let alert = alertify.alert("Error", cadena).set('label', 'Aceptar') ;    	 
             alert.set({transition:'slide'}); 
             alert.set('modal', true);
    })

}



function crearRubro(dato){

      if(!validar.vacio(dato)){
      
    let alert = alertify.alert("Error", "El campo esta vacio").set('label', 'Aceptar') ;    	 
    alert.set({transition:'slide'}); 
    alert.set('modal', true);  	
    return;
      } 
      
      $.post("/tesor/egresos/Rubro", 
      {nombreRubro:dato},

      function(data){
        
        alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
        alertify.notify(data.mensaje,'Exito',1, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 		  
              $("#rubroE").val("");
              $("#rubroE").focus();
              $("#rubro").append("<option value=" + data.dato.id + ">" + data.dato.nombre + "</option>");
         
      },
      'json'
      ).fail(function(fallo){

              let cadena="";
              $.each(fallo.responseJSON.errors, function (ind, elem) { 
                cadena+=elem  
               });

               let alert = alertify.alert("Error", cadena).set('label', 'Aceptar') ;    	 
               alert.set({transition:'slide'}); 
               alert.set('modal', true);
      })

}


function crearEgreso(rubro,detalle,cantidad,fecha,comentario){

   if(!validar.vacio(rubro,detalle,cantidad, fecha)){
    let alert = alertify.alert("Error", "Hay campos Vacios").set('label', 'Aceptar') ;    	 
    alert.set({transition:'slide'}); 
    alert.set('modal', true);  
    return false;
   }


   let arr= fecha.split("-");
let [ano, mes, dia] = arr;

 
$.post("/tesor/egresos",
{rubroE:rubro, detalleE:detalle,cantidadE:cantidad, 
  comen:comentario, diaE:dia, mesE:mes, anoE:ano }, 

  function(data){
 
   // alert(data.mensaje);  
   $("#rubro").val("");
    $("#id_detalleE").val("");
    $("#detalleEgreso").val("");
   $("#cantidadE").val("");
   $("#fechaE").val("");
   $("#comentario").val("");

   window.open("http://127.0.0.1:8000/tesor/egresos/comprobante/" + data.dato);

},'json'

).fail(function(xhr){
console.log(xhr);
})


}


$(document).ready(function(){
   $(".card").hide();

    //creo los rubros
    $("#guardRubro").click(function(){
        let dato=$("#rubroE").val();
      crearRubro(dato);
    });

    
//creo los detalles
$("#guarDetalle").click(function(){
  let dato=$("#detalleE").val();
crearDetalle(dato);
});


    //creo el egreso general
    $("#egreso_general").click(function(e){
      e.preventDefault();
      let idRubroE=$("#rubro").val();
      let idDetalleE=$("#id_detalleE").val();
      let cantidad=$("#cantidadE").val();
      let fecha= $("#fechaE").val();
      let comentario=$("#comentario").val();
   
      crearEgreso(idRubroE,idDetalleE, cantidad, fecha, comentario);

    });






//cuando escribo en el campo Detalle Rubro
    $("#detalleEgreso").keyup(function(event){
        $("#id_detalleE").val(""); //este es el input type hidden que contiene el id del detalle
   
        let cadena= $(this).val();

    if(cadena===""){
      $(".listaD").remove(); //la clase listaD son los li que contienen los detalles que coindicen con la busqueda
      return;
    }
                 
   $.get('/tesor/egresos/'+ cadena ,

        function( data, textStatus, jQxhr ){ 

       if(data.detalles.length>0){ 
           $(".listaD").remove();
           $(".card").show();
          if (!$(".lista .card  .cabecera").length){
            $(".lista .card").append("<div class='card-header cabecera'>" + "Selecciona un Detalle:" + "</div>")
            $(".lista .card").append("<ul class='list-group list-group-flush'></div>")
        }
           
        $.each(data.detalles, function (ind, elem) { 
            $(".lista .card ul").append("<li class='list-group-item listaD'  id=" + elem.id +  ">" +elem.nombre +"</li>")
           });
   
       
        }else{
            $(".listaD").remove();
        }

        
    },
    'json'
    )
    .fail(function( xhr, textStatus, errorThrown ){
    //consol
    
    });
    
    });


    //valido que sean solo numeros en input cantidad
$("#cantidadE").keypress(function(event){

  return valideKey(event); //valideKey es una funcion que esta en el archivo ingreso.js
});


     //cuando le doy click a uno de los li o de la lista de detalle
    $(document).on("click", ".listaD", function(){
     let id= $(this).attr("id"); //me traigo el valor del id de ese detalle que esta en el atributo id
     let nombre= $(this).text(); //me traigo el texto
     $("#id_detalleE").val(id);   //le pongo el valor de id al campo hidden de id_detalle
     $("#detalleEgreso").val(nombre); //le pongo el nombre al campo de Detalle rubro
     alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
          alertify.notify("Ha seleccionado: " +nombre  ,'Exito',2, null);

          $(this).remove();//elimino de la lista ese que selecciono

          if($(".listaD").length===0)  $(".card").hide(); //si al eliminar ese no hya mas opciones en la lista, oculto el div con clase card
    });



});