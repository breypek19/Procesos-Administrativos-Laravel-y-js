



function eliminarE(id_usuario){
  
    let id=id_usuario;
    
    var confirm= alertify.confirm('Eliminar Ingreso','Desea eliminar este ingreso?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'}); 	
      
    confirm.set({transition:'slide'});   	
     
    confirm.set('onok', function(){ //callbak al pulsar botón positivo
       
      $.ajax({
        url: "/tesor/egresos/"+id,    
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





    function editarEgreso(id){

      $.get('/tesor/egresos/'+ id + '/edit' ,
      function( data, textStatus, jQxhr ){    
  
        $("#rubroEgresoEdit option").removeAttr("selected");
  $("#rubroEgresoEdit option[value=" + data.datos[0].idRubro + "]").attr("selected", true); //esto es para seleccionar el rubro especifico que tiene el ingreso antes de editarlo
       $("#cantidadEgresEdit").val(data.datos[0].cantidad);
       $("#detalleEgresoEdit").val(data.datos[0].detalle)
       $("#id_detalleEgresoEdit").val(data.datos[0].idDetalle);
     //  $("#id_ingreso").val(data.datos[0].id);
       $("#comentarioEgresoEdit").val(data.datos[0].descripcion);
   
       $("#actuaEgresos").attr("action" , "http://127.0.0.1:8000/tesor/egresos/" + data.datos[0].id); //le paso al formulario la ruta y el id para que cuando envie el formulario lo actualice
   
      },
  
      'json'
  )
      .fail(function( xhr, textStatus, errorThrown ){
  //console.log(xhr);
      });    
   
  


    }








$(document).ready(function() {
    $('#egresos').DataTable( {
        "serverSide": true,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron registros -sorry",
            "info": " Pagina _PAGE_ of _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_  registros totales)"
           
        },
        "ajax": "/tesor/movimientos/egresos/registros/datos",
        "columns" :[
            {'data': 'id'},
            {'data': 'rubro'},
            {'data': 'detalle'},
            {'data': 'cantidad'},
            {'data': 'descripcion'},
            {'data': 'dia'},
            {'data': 'mes'},
            {'data': 'año'},
            {'data': 'action'},
           

            
        ]
    } );



$(document).on("click", ".editar", function(){

let id=$(this).attr("id");

editarEgreso(id);
    
});



$(document).on("click", ".eliminarEgre", function(){
  
let id= $(this).attr("id");
eliminarE(id);

});





$("#detalleEdit").keyup (function(event){
   
    let codigo = event.which || event.keyCode;

    if(codigo === 8){   //codigo 8 corrresponde a la tecla borrar
      return;
    }

    let id_detalle=$("#id_detalleEdit");
let cadena= $("#detalleEdit").val();


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
 $("#detalleEdit").val(obj.nombre); 
$("#id_detalleEdit").val(obj.id);
   
    }
    
},
'json'
)
.fail(function( xhr, textStatus, errorThrown ){
//consol

});

});



} );