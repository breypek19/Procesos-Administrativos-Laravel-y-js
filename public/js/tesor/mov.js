




//funcion que se ejcuta cuando se le da click al boton eliminar del datatable
function eliminar(id_usuario){
  
    let id=id_usuario;
    
    var confirm= alertify.confirm('Eliminar Ingreso','Desea eliminar este ingreso?',null,null).set('labels', {ok:'Confirmar', cancel:'Cancelar'}); 	
      
    confirm.set({transition:'slide'});   	
     
    confirm.set('onok', function(){ //callbak al pulsar botón positivo
       
      $.ajax({
        url: "/tesor/ingresos/"+id,    
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





    function editarIngreso(id){

      $.get('/tesor/ingresos/'+ id + '/edit' ,
      function( data, textStatus, jQxhr ){    
  
  $("#rubroEdit option").removeAttr("selected");

  $("#rubroEdit option[value=" + data.datos[0].idRubro + "]").attr("selected", true); //esto es para seleccionar el rubro especifico que tiene el ingreso antes de editarlo
       $("#cantidadEdit").val(data.datos[0].cantidad);
       $("#detalleEdit").val(data.datos[0].detalle)
       $("#id_detalleEdit").val(data.datos[0].idDetalle);
     //  $("#id_ingreso").val(data.datos[0].id);
       $("#comentarioEdit").val(data.datos[0].descripcion);
   
       $("#actua").attr("action" , "http://127.0.0.1:8000/tesor/ingresos/" + data.datos[0].id); //le paso al formulario la ruta y el id para que cuando envie el formulario lo actualice
   
      },
  
      'json'
  )
      .fail(function( xhr, textStatus, errorThrown ){
  //console.log(xhr);
      });    
   
  


    }




$(document).ready(function() {
    $('#ingresos').DataTable( {
        "serverSide": true,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron registros -sorry",
            "info": " Pagina _PAGE_ of _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtered from _MAX_ total records)"
           
        },
        "ajax": "/tesor/movimientos/registros/datos",
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

editarIngreso(id);
    
});



$(document).on("click", ".eliminar", function(){
  
let id= $(this).attr("id");
eliminar(id);

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