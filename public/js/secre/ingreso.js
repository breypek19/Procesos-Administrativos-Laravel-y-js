$(document).ready(function(){
$(".carg").hide();
$("#EstadoCivil").change(function(){

    $("#conyu").show();
  let valor= $(this).val();

  if(valor=="soltero"){
     $("#conyu").hide();
     $("#conyu #conyug").val("");
  }

})


//si el input de cantidad de hijos es mayor a 0 hago aparecer otro campo para escribir los nombres, sino, elimino ese campo
$("#cantidadH").change(function(){

  let val=  $(this).val();

  if(val>0){
      if(!$(".nomh").length){  //si no existe o no esta el form-group para escribir los nombres de los hijos
      $(".hijos").append('<div class="form-group nomh col-md-5 ml-5"  ><label>Nombres</label> <textarea id="nomHijos" class="form-control"  id="nomHijos" rows="2"></textarea></div>')
      }
    }else{
$(".nomh").remove();
  }
});



$(".bautis").change(function(){
 
  if($(this).val()=="si"){
let espiritu=$('input.espirituS:radio[name=espiritu]:checked').val();
    if(espiritu=="si"){
    $(".carg").show();
    }
      if(!$(".ba").length){
      $(".bauti").append('<div class="form-group ba  col-md-4"><label>Nombre Pastor</label> <input type="text" class="form-control" id="nomPastor" /></div>')
      $(".bauti").append('<div class="form-group ba  col-md-4"><label>Fecha Bautismo</label> <input type="date" class="form-control" id="fechaBaut" /></div>')
      }
    }else{
      $(".carg").hide();
        if($(".ba").length){
            $(".ba").remove();
            }
    }


});



      
$(".espirituS").change(function(){
    if($(this).val()=="si"){
      let baut=  $('input.bautis:radio[name=bautismo]:checked').val(); 
      if(baut=="si"){
        $(".carg").show();
      }
        if(!$(".esp").length){
        $(".espiri").append('<div class="form-group esp  col-md-4"><label>Fecha</label> <input type="date" class="form-control" id="fechaEspiritu" /></div>')
    
        }
      }else{
        $(".carg").hide();
        if($(".esp").length){
            $(".esp").remove();
            }
      }
  
  
  });
  
  




  $("#prof").on("change dblclick ", function(){

   let val=$(this).val();

   if(val=="0"){
$("#exampleModalCenter").modal("show");
   }

  });



  $("#guardOficio").click(function(){

      let dato= $("#oficio").val();

      if(!validar.vacio(dato)){
        let alert = alertify.alert("Error", "Hay campos Vacios").set('label', 'Aceptar') ;    	 
    alert.set({transition:'slide'}); 
    alert.set('modal', true);  
    return false;  
      }

      $.post("/secre/MovSecretaria/GuardarProfesion", {nom:dato}, 

            function(respuesta){
                alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
                alertify.notify(respuesta.mensaje,'Exito',1, null); 
                $("#oficio").val("");
           
                $("#prof #otro").before('<option value=' + respuesta.dato.id + ' selected >' + respuesta.dato.nombre  +  '</option>')

            }, 'json'
     ).fail(function(error){


        let cadena="";
              $.each(error.responseJSON.errors, function (ind, elem) { 
                cadena+=elem  
               });

               let alert = alertify.alert("Error", cadena).set('label', 'Aceptar') ;    	 
               alert.set({transition:'slide'}); 
               alert.set('modal', true);
     });

  });




//guardar persona...esta ejecuta una funcion guardar()
  $("#guardPersona").click(function(e){
e.preventDefault();

 guardarRegistros();


  });


  $("#identificacion").keypress(function(event){
    return  valideKey(event);  //al poner return false en estos eventos no se ejecuta el presionar la tecla
   
  });

  $("#telefono").keypress(function(event){
    return  valideKey(event);
   
  });


  $("input").focus(function(){
    $(".error").remove();
  })
  


});




//funcion guardar que se ejecuta al hacer click en guardar persona
function guardarRegistros(){

let nombres=$("#nombres").val();
 let apellidos=$("#apellidos").val();
 let lugar=$("#lugar").val();
 let fechaN=$("#fechaNac").val();
 let sexo=$("#sexo").val();
 let identi=$("#identificacion").val();
 let direccion=$("#direccion").val();
 let email=$("#correo").val();   //validar que se email valido
 let telef=$("#telefono").val();  //solo numeros
 let EstaCivil=$("#EstadoCivil").val();
let conyugue =  $("#conyug").val() ; //esta es dependiente

let cantidad=$("#cantidadH").val();
let nombresHijos=$("#nomHijos").val();
let profesion=$("#prof").val(); 


let bautismo= $('input.bautis:radio[name=bautismo]:checked').val();   //esta es con undefined con true o false
let nomPastor=$("#nomPastor").val(); //dependiente
let fechaBaut=$("#fechaBaut").val();//dependiente

let espiritu= $('input.espirituS:radio[name=espiritu]:checked').val();
let fechaEsp=$("#fechaEspiritu").val();


let cargos=$("#cargos").val();
let estado=$("#estado").val();


if( !validar.vacio(nombres, apellidos, lugar, fechaN, identi, direccion,telef, profesion, cantidad)){
   
  if(!$(".error").length){
  $(".mensaje").append('<div style="width:50%" class="alert alert-danger error" role="alert">'+ "Hay campos vacios"  + "</div>");	
  }
  $('html, body').animate({
    scrollTop: $("h3").offset().top
    }, 1000);
  
  return;
};


if(!validar.sinDatos(bautismo, espiritu)){   //si los campos bautismo y espiritu son indefinidos, es decir si no se marco ningun radio button en ambos de si o no, muestra mensaje de error y paro la ejecucion
  if(!$(".error").length){
    $(".mensaje").append('<div style="width:50%" class="alert alert-danger error" role="alert">'+ "No ha completado los datos"  + "</div>");	 
  } 
  $('html, body').animate({
    scrollTop: $("h3").offset().top
    }, 1000);

    return; 
}else{

    if(bautismo=="si"){
    
        if( !validar.vacio(nomPastor, fechaBaut)){

            let alert = alertify.alert("Error", "No ha llenado los datos del bautismo").set('label', 'Aceptar') ;    	 
          alert.set({transition:'slide'}); 
          alert.set('modal', true);  	
          return;
        };

    }

    if(espiritu=="si"){
       if(!validar.vacio(fechaEsp)){
        let alert = alertify.alert("Error", "Complete la fecha del Bautismo del Espiritu Santo").set('label', 'Aceptar') ;    	 
          alert.set({transition:'slide'}); 
          alert.set('modal', true);  	
          return;
       }

    }
}

if(EstaCivil=="casado"){
    if(!validar.vacio(conyugue)){
      if(!$(".error").length){
        $(".mensaje").append('<div style="width:50%" class="alert alert-danger error" role="alert">'+ "Campos Vacios"  + "</div>");	 
      } 
      $('html, body').animate({
        scrollTop: $(".h3").offset().top
        }, 1000);
       }

}

if(validar.vacio(email)){
  if(!validar_email(email)){
    if(!$(".error").length){
      $(".mensaje").append('<div style="width:50%" class="alert alert-danger error" role="alert">'+ "Correo Incorrecto"  + "</div>");	 
    } 
    $('html, body').animate({
      scrollTop: $("h3").offset().top
      }, 1000); 	
          return;
}
}


if(cantidad>0){
  if(!validar.vacio(nombresHijos)){
    if(!$(".error").length){
      $(".mensaje").append('<div style="width:50%" class="alert alert-danger error" role="alert">'+ "Campos Vacios"  + "</div>");	 
    } 
    $('html, body').animate({
      scrollTop: $("h3").offset().top
      }, 1000);  	
      return;
   }
}else{
 // nombresHijos="no registra";
}


$.post("/secre/MovSecretaria", 
{
nombresP:nombres, apellidosP:apellidos,lugarN:lugar,
fechaNacP:fechaN, sexoP:sexo, identificacionP:identi,
direccionP:direccion, correoP:email, telefonoP:telef, estadoCiviP:EstaCivil,
pareja:conyugue, cantidadHijoP:cantidad, nombreHijosP:nombresHijos,
profesionP:profesion, bautismoP:bautismo, nombrePastorP:nomPastor, fechaBautiP:fechaBaut,
EspirituS:espiritu, fechaE:fechaEsp, cargosServicio:cargos, estadoP:estado

}, 
function(respuesta){
$(".mensaje").append('<div class="alert alert-success exito" role="alert">' + respuesta.mensaje + "!" + "</div>");

$('html, body').animate({
  scrollTop: $("h3").offset().top
  }, 1500);

  limpiar();

  setTimeout(function(){ $(".exito").remove()}, 2500);

}, 'json'
).fail(function(error){

  let cadena="";
  $.each(error.responseJSON.errors, function (ind, elem) { 
    cadena+=elem  
   });

   let alert = alertify.alert("Error", cadena).set('label', 'Aceptar') ;    	 
   alert.set({transition:'slide'}); 
   alert.set('modal', true);
})

}



function limpiar(){


  $('#formo input[type="text"]').val("");
  $('#formo input[type="date"]').val("");
  $("#cargos").val("");  //type textarea
 $("#correo").val("");   //type email


$("#EstadoCivil").val("casado");  //type select
$("#prof").val("");  //  type select
$("#estado").val("activo"); //type select

$("#cantidadH").val("");  //type number


$("input.espirituS, input.bautis").prop("checked", false);  //le quito el checked a los radio button de bautismo y espiritu santo
}