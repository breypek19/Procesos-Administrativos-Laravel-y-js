
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});



let formatNumber = {
  separador: ".", // separador para los miles
  sepDecimal: ',', // separador para los decimales
  formatear:function (num){
  num +='';
  let splitStr = num.split('.');
  let splitLeft = splitStr[0];
  let splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
  let regx = /(\d+)(\d{3})/;
  while (regx.test(splitLeft)) {
  splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
  }
  return this.simbol + splitLeft +splitRight;
  },
  new:function(num, simbol){
  this.simbol = simbol ||'';
  return this.formatear(num);
  }
 }


/*
function redireccion() {
    window.location = "http://localhost:8000/login";
   
    
}

//si intento ir al login antes del tiempo de cierre de sesion no me lo va a permitir, ya que
//esto esta programado, si tiene la sesion abierta aun e intenta ir al login va a redirigir al /admin, /tesor, /secre
//por ello, debeo saber cuanto es el tiempo de sesion del servidor, y sabiendo ello pongo el mismo tiempo aca o un poquito mas

// se llamará a la función que redirecciona después de 10 minutos (600.000 segundos)
var temp = setTimeout(redireccion, 3600000);  //60 minutos

// cuando se pulse en cualquier parte del documento
document.addEventListener("click", function() {
    // borrar el temporizador que redireccionaba
    clearTimeout(temp);
    // y volver a iniciarlo
    temp = setTimeout(redireccion, 3600000);
})


*/

function validar_email( email ) 
{
    let regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
} 



let validar= {
    vacio: function(...dato){
      

        for(let i=0;i<dato.length;i++){
            if(dato[i].length===0)return false;
            
        }

        return true;
        
    },

    sinDatos:function(...datos){

      for(let i=0;i<datos.length;i++){
        if(!datos[i])return false;
        
    }
    return true;
    },

    longitud:function(dato,longitud){
        if(dato.length<=longitud)return false;
        return true;
    }
}


function valideKey(evt)
  {
    let code = (evt.which) ? evt.which : evt.keyCode;
   
 if( ( code>=48 && code<=57) || code===8) 
    {
      //is a number, or es tecla borrado
      return true;
    }
    else
    {
      return false;
    }
  }


