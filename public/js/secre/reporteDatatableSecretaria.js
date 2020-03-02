
$(document).ready(function(){
$('#ReportSecre').DataTable( {
    "serverSide": true,
    "language": {
        "lengthMenu": "Mostrar _MENU_ registros por pagina",
        "zeroRecords": "No se encontraron registros -sorry",
        "info": " Pagina _PAGE_ of _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtered from _MAX_ total records)"
       
    },
    "ajax": "/secre/Reportes/reporteGeneral",
    "columns" :[
        {'data': 'id'},
        {'data': 'nombres'},
        {'data': 'apellidos'},
        {'data': 'fecha_bautismo'},
        {'data': 'pastor_bautismo'},
        {'data': 'fecha_espiritu'},
        {'data': 'estado'}
       

        
    ]
} );




   $.get("/secre/Reportes/ReportCantidad", function(success){
         console.log(success.cantidadHM.length);
    $("#total strong").append(success.total);
    $("#jovenes strong").append(success.cantidadJovenes);
    $("#bautizadosSinE strong").append(success.bautizadosSinEspiritu);
    $("#visitas strong").append(success.visitas);
  
    if(success.cantidadHM.length==0){
             $("#H strong ").append(0);
             $("#M strong ").append(0);
   
    }else{
        
         $("#H strong ").append(success.cantidadHM[1].cantidad);
    $("#M strong ").append(success.cantidadHM[0].cantidad);
   
    }
  

   }, 'json'
   ).fail(function(error){


   });





   //reportes Pdf
$("#total").click(function(e){   //hermanos total bautizados
    e.preventDefault();
    
    window.open("http://127.0.0.1:8000/secre/Reportes/BautizadosGeneral");
    })
    
    
    $("#jovenes").click(function(e){  //solo jovenes bautizados
        e.preventDefault();
        
        window.open("http://127.0.0.1:8000/secre/Reportes/JovenesBautizados");
    
        });
    
    
  $("#M").click(function(e){  //solo jovenes bautizados
     e.preventDefault();
            
     window.open("http://127.0.0.1:8000/secre/Reportes/DorcasBautizadas");
            });


  $("#visitas").click(function(){

 window.open("http://127.0.0.1:8000/secre/Reportes/Visitas");
  });

      
  $("#bautizadosSinE").click(function(){

 window.open("http://127.0.0.1:8000/secre/Reportes/SinEpiritu");
 });



     
 $("#H").click(function(){

    window.open("http://127.0.0.1:8000/secre/Reportes/Caballeros");
    });

 

     


});