$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const cadena= "abcdefghijklmnopqrstuvwxyz";
const mayusc= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
const numero="0123456789";
  const simbolo="!=?%&/¡$¿#*-";


///////////////////////////////////////////////////////////////////////////////////
  //funciones para validar que el campo input contenga tanto minuscula, mayuscula, numeros y simbolos 
//verifico si tiene alguna letra....si coincide alguna letra o palabra del inpu o nombre usuario
//    retorno true y salgo.....luego, si cuando termine el for ninguno coincidió, retorno false
function letras(inpu){
for(let i=0;i<inpu.length;i++){
 if(cadena.indexOf(inpu.charAt(i))!=-1 ){
    return true;
    break;
 } 
     }
      return false;
}

function letrasMay(inpu){
  for(let i=0;i<inpu.length;i++){
   if(mayusc.indexOf(inpu.charAt(i))!=-1 ){
      return true;
      break;
   } 
       }
        return false;
  }

function numeros(inp){
for(let i=0;i<inp.length;i++){
 if(numero.indexOf(inp.charAt(i))!=-1 ){
    return true;
    break;
 } 
     
     }
      return false;
}

function simbolos(inpuy){

  for(let i=0;i<inpuy.length;i++){
   if(simbolo.indexOf(inpuy.charAt(i))!=-1){
      return true;
      break;
   } 
        
       }
  
       return false;
  }
/////////////////////////////////////////////////////////////////////////////7


// funcion que devuelve el string con solo numeros
function cadenaNumeros(string){
  let out = '';
  let filtro = numero;

  //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
  for (let i=0; i<string.length; i++){
     if (filtro.indexOf(string.charAt(i)) != -1){ 
           //Se añaden a la salida los caracteres validos
     out += string.charAt(i);
     }
    }
     
  //Retornar valor filtrado
  return out;

}


//funcion para validar email
function validar_email( email ) 
{
    let regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}


//funcion que devuelve el string poniendo el primer caracter en mayuscula
function MaysPrimera(string){
  return string.charAt(0).toUpperCase() + string.slice(1);
  
}

//funcion que establece que el nombre de usuario sea solo letras y numeros, sin simbolos,
// sin espacios
function sinEspacios(string){
  let out = '';
  let filtro = cadena + mayusc + numero;

  //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
  for (let i=0; i<string.length; i++){
     if (filtro.indexOf(string.charAt(i)) != -1 && string.charAt(i)!= " "){ 
           //Se añaden a la salida los caracteres validos
     out += string.charAt(i);
} 
 }

return out;
}


function sinCamposBlancos(...datos){

  for(let i=0;i<datos.length;i++){
    if(datos[i].length==0){
      return true;
  } 
}
return false;
}

function validar_password(pass){

 if(letras(pass) && letrasMay(pass) && numeros(pass) && simbolos(pass)){
   return true;
 }
 return false;

}

function password_coinciden(pass1,pass2){
  let password= pass1===pass2 ? true : false;
  return password;
}

function longitudPassw(dat){

   let result= dat.length > 6 ? true : false;

   return result;
}


function actualizar(id, email, pass, rol){

  $.ajax({
    type: "PUT",
    url: "/admin/users/"+id,  
    data: {
   
      email_usuario:email,
      password_usu:pass, rol_us:rol 
  },  
    dataType : "text",
    beforeSend: function() {  
     // $("#guard").css("border-style", "none");
    //  $('#guard').html('<img  src="/img/loading.gif">').attr("disabled","disabled");
    $('#guard').attr("disabled","disabled")
    $("#guard").text("Cargando....");
   
    }
})
  .done(function( mensaje ) {
    setTimeout(function() {
     // $('#guard').html('Guardar').removeAttr("disabled");
     $('#guard').text('Usuario actualizado').removeAttr("disabled");
      $('#guard').addClass("btn btn-primary btn-lg px-5");
      window.location.replace("http://127.0.0.1:8000/admin/"); 
    }, 1000);
  })
  .fail(function( xhr, status, errorThrown ) {
    console.log(xhr);
    console.log(status);
  })
  
  .always(function( xhr, status ) {
  //  alert( "The request is complete!" );
  });
}


//funcion que recibe el id_del usuario y realiza la peticion ajax
function eliminar(id_usuario){
  
let id=id_usuario;

var confirm= alertify.confirm('Eliminar usuario','Desea eliminar el usuario?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'}); 	
  
confirm.set({transition:'slide'});   	
 
confirm.set('onok', function(){ //callbak al pulsar botón positivo
   
  $.ajax({
    url: "/admin/users/"+id,    
    type: "DELETE",
    dataType : "text",
})
  .done(function( mensaje ) {
    alertify.success(mensaje);
  })
  .fail(function( xhr, status, errorThrown ) {
    console.log(xhr);
    console.log(status);
  })
  
  .always(function( xhr, status ) {
  //  alert( "The request is complete!" );
  });
   	
});
 
confirm.set('oncancel', function(){ //callbak al pulsar botón negativo
    alertify.error('Has Cancelado');
});

}






$( document ).ready(function() {

  $("#emai").hide();
  $("#password").hide();
  $("#confirmacion").hide();
  $("#dang").hide();
$("#nom_usuario").hide();
$("#mensaje-servidor").hide();
$("#mensaje-servidor").html("");


//valida el  nombre de usuario...Puedo usar kepress, keyup para que acepte solo numeros, letras sin espacios con la funcion sinEspacios()
$("#nom").keyup( function(){
  let cadena= MaysPrimera($(this).val());  //convierto la primera letra del input nombreusuario a mayuscula
  $("#nom").val(sinEspacios(cadena)); //uso la funcion para quitar espacios y simbolos raros, solo numeros y letras
   
});
  


  //eliminar usuario

  $(".eliminar").click(function(e){
 e.preventDefault();
     let id= $(this).data("id");
      eliminar(id);
  });

  
//editar y guardar
  $("#guard").click(function(){
 //no me traigo el nombre de usuario, porque ese no se va a modificar
    let email= $("#email_u").val().trim();
     let password= $("#pass_u").val().trim();
     let confirma= $("#password-c").val().trim();
     let rol=  parseInt( $("#selec_us").val());
      let id_usu=parseInt($("#id_usu").val());

     if(sinCamposBlancos(email,password,confirma)){
     
     let alert = alertify.alert("Errores", "Hay Campos Vacios").set('label', 'Aceptar') ;    	 
     alert.set({transition:'flipx'}); //slide, zoom, flipx, flipy, fade, pulse (default)
     alert.set('modal', true);  //al pulsar fuera del dialog se cierra o no	
         return;
     }

     if(!validar_email(email)) {

      alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
      alertify.notify('Correo incorrecto','error',1, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click 		  
    return;
}

if(!longitudPassw(password)){
  alertify.set('notifier','position', 'top-right');
alertify.notify('La contraseña es muy corta','warning',3, null);
     return;
}

if(!validar_password(password)){
  alertify.set('notifier','position', 'boottom-right');
  alertify.message('La contraseña debe tener  Minusculas, Mayusculas, Números y  Simbolos (!=?%&/¡$¿#*-)',6, null);
  return;
}

if(!password_coinciden(password, confirma)){
  alertify.message('No coindiden las contraseñas',0, null);
return;
}

actualizar(id_usu, email,password, rol);

  });



 
    //crear y guardar usuario
    $("#bton-guardar").click(function(){
           
      let  nom= $("#nom").val().trim();
       let email= $("#email").val().trim();
        let password= $("#pass").val().trim();
        let confirma= $("#password-confirm").val().trim();
        let rol=  parseInt( $("#selec").val());

     
    $("#nom_usuario").hide();
    $("#confirmacion").hide();
    $("#dang").hide();
    $("#mensaje-servidor").html("");
    $("#mensaje-servidor").hide();
    $("#emai").hide();
    $("#password").hide();
    $("#confirmacion").html("");
      $("#emai").text("");
    $("#dang").text("");
  


     
     //valido que no hayan campos vacios...si es asi, pongo un mensaje de alerta y detengo la ejecucion

     if(sinCamposBlancos(nom,email,password, confirma)){
    $("#dang").text("Hay campos vacios");
    $("#dang").show();
        return;
}

if(nom.length<7){
  $("#nom_usuario").text("El usuario debe tener minimo 7 caracteres");
  $("#nom_usuario").slideDown(700);
return;
}


// uso la funcion validar_email, si retorna false muestro mensaje de advertencia y detengo la ejecucion
if(!validar_email(email)) {
      $("#emai").html(" <strong>Error!</strong> Email invalido."); 
      $("#emai").show();
    return;
}



//valido que la contraseña tenga minimo 6 caracteres...si los tiene, valido que sean letras, numeros y simbolos
      if(!longitudPassw(password)){
          
         $("#password").text("la contraseña debe ser minimo de 7 caracteres");
         $("#password").show();
            return;
          

      } else if(validar_password(password)){ //si la contraseña cumple con letra, numero y simbolos quito el mensaje de advertencia.
          
       $("#password").text("");
       $("#password").hide();
      
   }else{  //si la contraseña no contiene letras, numeros y simbolos (no pasa la validacion)--muestro mensaje de advertencia y hago return para que no siga la ejecucion;
       
       $("#password").text("la contraseña debe tener letras minusculas y mayusculas, numeros y algun caracter especial como ! / = % & $");
      $("#password").show();
       $("#pass").val("");  //valor del input de contraseña
      $("#password-confirm").val("");  //valor de confirmacion de contraseña
       return;     //detengo la ejecución
 }

if(confirma!==password){
      $("#confirmacion").text("No coinciden las contraseñas");
      $("#confirmacion").slideDown();
      $("#pass").val("");  //valor del input de contraseña
      $("#password-confirm").val("");  //valor de confirmacion de contraseña
    return;
    }

         
      $.ajax({
 
    url: "/admin/users",
    data: {
        nom_usuario: nom, email_us:email,
        passw:password, rol_us:rol 
    },
 
    type: "POST",
    dataType : "json",
})
  
  .done(function( mensaje ) {

let interval = setInterval(function(){  //setInterval con 0, llama a la funcion continuamente con un mínimo retraso
  $("#dang").text(mensaje);
  $("#dang").show();
}, 0);

// A los 2 segundos cancelo ejecucion 
setTimeout(function(){ 
  clearInterval(interval);  //ejecuto clearInterval despues de 2 segundos
  $("#dang").hide();
}, 3500);

    $("#nom").val("");
        $("#email").val("");
         $("#pass").val("");
         $("#password-confirm").val("");
         $("#nom").focus();

    
    // $( "<h1>" ).text( json.title ).appendTo( "body" );
    // $( "<div class=\"content\">").html( json.html ).appendTo( "body" );
  })
  // Code to run if the request fails; the raw request and
  // status codes are passed to the function
  .fail(function( xhr, status, errorThrown ) {
   
    let cadena="<ul>";
    $.each(xhr.responseJSON.errors, function (ind, elem) { 
    cadena+= "<li>" + elem + "</li>";
});
  
 
    
  

  $("#mensaje-servidor").html(cadena + "</ul>");
  $("#mensaje-servidor").show();
  })
  // Code to run regardless of success or failure;
  .always(function( xhr, status ) {
  //  alert( "The request is complete!" );
  });


  
    });

  

});


