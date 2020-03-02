



$(document).ready(function(){


 $("input#inputBu").focus(function(){
   $(".error").remove();

    });


//evento que se ejcuta al escribir la persona a buscar en el campo
$("#inputBu").keyup(function(){
$(".result").remove();

let campo= $(this).val();

if(campo.length==0){
    return;
}

Buscar(campo);

})


//evento que se ejcuta al dar click en una persona de la lista
$(document).on("click", ".persona", function(e){
    e.preventDefault();
let id= $(this).attr("idPersona");

$("#exampleModal").modal("show");

BuscarPersona(id);

});

//////////////////////////////////////////////////////////////////////////////////////////
////se ejecuta cuando se modifica algo en el modal para actualizar////////////////////////77777

$("input").focus(function(){
    $(".error").remove();
  });

  $(".carg").hide();

  $("#EstadoCivil").change(function(){

    $("#conyu").show();
  let valor= $(this).val();

  if(valor=="soltero"){
     $("#conyu").hide();
   
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



//actualizar persona

$("#actualizar").click(function(){

validarPersona();


});







});









///////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////FUNCIONES////////////////////////////////////////////////

function validarPersona(){

    let id=$("#id_persona").val();
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
    $(".mensajePersona").append('<div style="width:50%" class="alert alert-danger error" role="alert">'+ "Hay campos vacios"  + "</div>");	
    }
    $('html, #exampleModal').animate({
      scrollTop: $(".mensajePersona").offset().top
      }, 1000);
    
    return;
  };


  if(!validar.sinDatos(bautismo, espiritu)){   //si los campos bautismo y espiritu son indefinidos, es decir si no se marco ningun radio button en ambos de si o no, muestra mensaje de error y paro la ejecucion
    if(!$(".error").length){
      $(".mensajePersona").append('<div style="width:50%" class="alert alert-danger error" role="alert">'+ "No ha completado los datos"  + "</div>");	 
    } 
    $('html, #exampleModal').animate({
      scrollTop: $(".mensajePersona").offset().top
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
          $(".mensajePersona").append('<div style="width:50%" class="alert alert-danger error" role="alert">'+ "Campos Vacios"  + "</div>");	 
        } 
        $('html, #exampleModal').animate({
          scrollTop: $(".mensajePersona").offset().top
          }, 1000);
         }
  
  }
  
  if(validar.vacio(email)){
    if(!validar_email(email)){
      if(!$(".error").length){
        $(".mensajePersona").append('<div style="width:50%" class="alert alert-danger error" role="alert">'+ "Correo Incorrecto"  + "</div>");	 
      } 
      $('html,#exampleModal').animate({
        scrollTop: $(".mensajePersona").offset().top
        }, 1000); 	
            return;
  }
  }
  
  
  if(cantidad>0){
    if(!validar.vacio(nombresHijos)){
      if(!$(".error").length){
        $(".mensajePersona").append('<div style="width:50%" class="alert alert-danger error" role="alert">'+ "Campos Vacios"  + "</div>");	 
      } 
      $('html, #exampleModal').animate({
        scrollTop: $(".mensajePersona").offset().top
        }, 1000);  	
        return;
     }
  }



$.ajax({
url: "/secre/MovSecretaria/" + id,
type:'PUT',
dataType : "json",
data:{nombresP:nombres, apellidosP:apellidos,lugarN:lugar,
    fechaNacP:fechaN, sexoP:sexo, identificacionP:identi,
    direccionP:direccion, correoP:email, telefonoP:telef, estadoCiviP:EstaCivil,
    pareja:conyugue, cantidadHijoP:cantidad, nombreHijosP:nombresHijos,
    profesionP:profesion, bautismoP:bautismo, nombrePastorP:nomPastor, fechaBautiP:fechaBaut,
    EspirituS:espiritu, fechaE:fechaEsp, cargosServicio:cargos, estadoP:estado
    }

}).done(function(respuesta){
    $(".mensajePersona").append('<div style="width:50%" class="alert alert-success error" role="alert">'+ respuesta.mensaje + "</div>");	 
    $('html,#exampleModal').animate({
        scrollTop: $(".mensajePersona").offset().top
        }, 1000); 
        setTimeout(function(){
         $(".error").remove();
        }, 2000)
}).fail(function(error){
    console.log(error);
})



}








//funcion que se ejecuta al escribir en el campo de buscar
function Buscar(campo){

    $.get("/secre/MovSecretaria/" + campo,
   
     function(success){
        console.log(success.personas);
        
        if(success.personas.length===0){  //si no hay resultados despues de la busqueda
            if(!$(".error").length){
            $(".mensaje").append('<div class="text-success error my-1"  >No hay Coincidencias</div>'); 
            }
            $(".result").remove();

        }else{

         $(".result").remove();

            if($(".error").length){
                $(".error").remove(); 
         }  

       $(".repo").append('<div class=" col-8 col-sm-10 col-md-7 col-lg-7 border bg-white result"><ul  class="list-group"> </ul></div>');

       success.personas.forEach(element => {
        $(".result ul").append('<li class="list-group-item border-0 persona" idpersona=' + element.id + '>' + '<a href=""><strong class="text-danger">Nombre:</strong>  ' +  (element.nombreCompleto).replace(/\b[a-z]/g,c=>c.toUpperCase()) + ',   <strong class="text-danger   ">Identificacion:</strong> ' + element.identificacion +  "</a></li>");
    });
    

        }


        
        
        }, 'json'
        ).fail(function(){
        
        })
}



//funcion que se ejcuta cuando doy click en una persona de la lista para buscar todos sus datos
function BuscarPersona(id){


$.get("/secre/MovSecretaria/" + id + "/edit", 

function(persona){

llenar(persona.datos);

}, 'json'
).fail(function(){

})

}


function llenar(datos){
  
    $("#id_persona").val(datos.id);
    $("#conyu").show();

    if(datos.estado_civil=="soltero"){
        $("#conyu").hide();
    // $("#conyu #conyug").val("");
    }

    if(datos.cant_hijos>0){
        if(!$(".nomh").length){  //si no existe o no esta el form-group para escribir los nombres de los hijos
            $(".hijos").append('<div class="form-group nomh col-md-5 ml-5"  ><label>Nombres</label> <textarea id="nomHijos" class="form-control"  id="nomHijos" rows="2"></textarea></div>')
            }
    }else{
        $(".nomh").remove();
    }


    if(datos.bautismo=="si"){  //si el dato de bautismo que vine de la base de datos es si
        
        if(datos.espiritu=="si"){
            $(".carg").show();
          }  //muestro el textarea de los cargos
              if(!$(".ba").length){  //si no existen, creo los otros dos campos del bautismo
              $(".bauti").append('<div class="form-group ba  col-md-4"><label>Nombre Pastor</label> <input type="text" class="form-control" id="nomPastor" /></div>')
              $(".bauti").append('<div class="form-group ba  col-md-4"><label>Fecha Bautismo</label> <input type="date" class="form-control" id="fechaBaut" /></div>')
              }
            
    }else{  //si el bautismo es no 
        $(".carg").hide(); //oculto el textarea de los cargos
        if($(".ba").length){
            $(".ba").remove(); // elimino los dos campos del bautismo
            }
    }


    if(datos.espiritu=="si"){
        if(datos.bautismo=="si"){
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



 $("#nombres").val(datos.nombres);
$("#apellidos").val(datos.apellidos);
$("#lugar").val(datos.lugar_nacimiento);
 $("#fechaNac").val(datos.fecha_nacimiento);

 $("#sexo option[value="+ datos.sexo +"]").attr("selected",true);
$("#identificacion").val(datos.identificacion);
$("#direccion").val(datos.direccion_residencia);
$("#correo").val(datos.correo);   
$("#telefono").val(datos.telefono);  
$("#EstadoCivil option[value="+ datos.estado_civil +"]").attr("selected",true);
$("#conyug").val(datos.nom_conyugue) ; 
$("#cantidadH").val(datos.cant_hijos);
$("#nomHijos").val(datos.nombre_hijos);
$("#prof option[value="+ datos.profesion_id +"]").attr("selected",true);

let radioBautismos = $('input.bautis:radio[name=bautismo]');
 radioBautismos.filter('[value=' +datos.bautismo + ' ]').prop('checked', true);


 let radioEspiritu = $('input.espirituS:radio[name=espiritu]');
 radioEspiritu.filter('[value=' +datos.espiritu + ' ]').prop('checked', true);
$("#nomPastor").val(datos.pastor_bautismo); 
$("#fechaBaut").val(datos.fecha_bautismo);
$("#fechaEspiritu").val(datos.fecha_espiritu);
$("#cargos").val(datos.cargos);
$("#estado option[value="+ datos.estado +"]").attr("selected",true);
}
