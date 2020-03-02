




$(document).ready(function() {
  

    var datosAño;
    var datosMeses;
    var datos=[];
    

  let mes= new Date().getMonth()+1;
    if(mes<10) {
        mes='0'+mes;
    } 
    //se crea desde javascript, es decir, cuando se carga el documento se crea este enlace para la descarga del reporte
    $("#info div").append("<a" + ' href="#"' + ' id="informe"' + " >" + "Informe General" + mes + ".pdf" + "</a>");
    $("#me").append("<strong>" +  mes  + "</strong>");
    $("#info-meses #form").after("<a" + ' class="mt-3"'  + ' href="#"' + ' id="info-m"' + " >" + "Informe General meses" + ".pdf" + "</a>");


//para descargar por rubros
$(document).on('click', "#descarga ", function(e){
    e.preventDefault();
let id=e.target.attributes["data-colu"].nodeValue;
let an=$("#filtaño").val();
let mes= $("#meses").val();

if(an==="0"){
  if(mes==="0"){
    window.open("http://127.0.0.1:8000/tesor/movimientos/reportes/ingresos/" + id);
  }else{
    window.open("http://127.0.0.1:8000/tesor/movimientos/reportes/ingresos/" + id+ "/" + "2" + "/" + mes);
  }
  
}else if(mes=="0"){
  window.open("http://127.0.0.1:8000/tesor/movimientos/reportes/ingresos/" + id + "/" + an);
}else{
  window.open("http://127.0.0.1:8000/tesor/movimientos/reportes/ingresos/" + id + "/" + an + "/" + mes);
}


});


//para descargar informe general por mes determinado
$(document).on('click', "#informe ", function(e){
    e.preventDefault();
    
window.open("http://127.0.0.1:8000/tesor/movimientos/reportes/ingresosGeneral/" + mes);

    
    });


    //para descargar informe general por rango de meses
$(document).on('click', "#info-m ", function(e){
    e.preventDefault();
    let inicio=$("#inicio").val();
    let fin=$("#fin").val();
    
if( inicio > fin )return;

window.open("http://127.0.0.1:8000/tesor/movimientos/reportes/ingresosGeneral/" + inicio + '/' + fin );

    
    });


    //para descargar por detalle y rubro
$(document).on('click', "#descargaDet ", function(e){
e.preventDefault();
    let id=e.target.attributes["data-id"].nodeValue;
    let id_rub=$("#rub").val();
    
    let an=$("#filtaño").val();
    if(an==="0"){
      window.open("http://127.0.0.1:8000/tesor/movimientos/reportes/ingresosDet/" + id + '/' + id_rub );
    }else{
      window.open("http://127.0.0.1:8000/tesor/movimientos/reportes/ingresosDet/" + id + '/' + id_rub + "/"  + an);
    }
    
    
    });


    $("#rub").change(function(){

        
      $("#filtaño option").removeAttr("selected");
      $("#filtaño option[value='0']").attr("selected", true);;

      $("#meses option").removeAttr("selected");
      $("#meses option[value='0']").attr("selected", true);

        let id= $(this).val();
        
        $.get('/tesor/movimientos/registros/repor/'+ id ,
        function( data, textStatus, jQxhr ){    
            let total=0;
        //si hay datos a mostrar en el select de DETALLE
     if(data.detalles.length>0){
           $("#detall").empty();
           $("#detall").append('<option>Selecciona un Detalle</option>');
          
            $.each(data.detalles,function(key,value){
          
          $("#detall").append('<option value="'+value.id+'">'+ value.nombre.toUpperCase()+'</option>');
           });
        }
        else{
            $("#detall").empty();
            $("#detall").append('<option>Selecciona un Detalle</option>');
        }
       
       //si hay datos a mostrar en la tabla
          if(data.datos.length>0){
            $("#report tbody tr").remove();
            $("#report str").remove();
           
         
           
            $.each(data.datos,function(key,value){
                 total+=value.total
                $('#report ').append('<tr class="p-3 text-capitalize"><td>' + value.detalle + '</td><td>' + formatNumber.new(value.total , "$") +  '</td><td>' + value.mes +  '</td><td>' + value.año + '</td></tr>');
                 });
                  
                 $("#tot").val('$ ' + formatNumber.new(total));

                 if(!$("#report  #descarga").length){
                    $("#report").append('<a data-colu=' +id  + ' class="m-3"' + ' href="#"' + ' id="descarga"' + '>' + "Reporte.pdf"  +'</a>')
                    $( "#descargaDet").remove();
                 }else{
                   
                   $( "#report #descarga" ).attr("data-colu", id );
                   $( "#descargaDet").remove();
                 }
                

          }else{
              $( "#descarga ").remove();
              $( "#descargaDet").remove();
              $('#report strong').remove();
            $("#report tbody tr").remove();
            $('#report tbody').append('<tr class="str"><td class="sin"><strong>' + "Sin resultados " + '</strong></td>' + '<td class="sin"></td>' + '<td class="sin"></td>' + '<td class="sin"></td>' +' </tr>');
            $("#tot").val("0");
          }

  datosAño= $("#report tr td:nth-child(4)");   //columna donde estan los años, ultima columna
  datosMeses= $("#report tr td:nth-child(3)");  //columna donde estan los meses, tercer columna
 

        },
        'json'
    )
        .fail(function( xhr, textStatus, errorThrown ){
  //console.log(xhr);
        });    
     
        
        
        });











        $("#detall").change(function(){

          $("#filtaño option").removeAttr("selected");
          $("#filtaño option[value='0']").attr("selected", true);;

          $("#meses option").removeAttr("selected");
          $("#meses option[value='0']").attr("selected", true);
        

            let id_rub=$("#rub").val();
            let id= $(this).val();
                $.get('/tesor/movimientos/registros/repor/'+ id_rub + '/' + id ,
                function( data, textStatus, jQxhr ){    
                    console.log(data);
           
                  if(data.registros.length>0){
                    $("#report td").remove();
                    $("#report strong").remove();
                  //  $("#report #deta-en").remove();  //elimino la columna Detalle de la tabla
                    let total=0
                    $.each(data.registros,function(key,value){
                        total+=value.total
                        $('#report').append('<tr><td>'  + value.detalle + '</td><td>' + formatNumber.new(value.total , "$") +  '</td><td>' + value.mes +  '</td><td>' + value.año + '</td></tr>');
                         });

                         $("#tot").val("$" + formatNumber.new(total));

                         if(!$("#report  #descargaDet").length){
                           $("#report").append('<a data-id=' +id  +  ' href="#"' + 'class="m-3"' + ' id="descargaDet"' + '>' + "ReporteDetalle.pdf"  +'</a>')
                        
                         }else{
                           
                           $( "#report #descargaDet" ).attr("data-id", id );
                         }
        
                  }else{
                    $( "#descargaDet").remove();
                    $("#report td").remove();
                    $('#report').append('<strong>' + "Sin resultados " + '</strong>');
                  }
              
                  datosAño= $("#report tr td:nth-child(4)"); 
                  datosMeses= $("#report tr td:nth-child(3)"); 
                  $('#filtaño option[value=0 ').attr("selected",true);
                },
                'json'
            )
                .fail(function( xhr, textStatus, errorThrown ){
          //console.log(xhr);
                });
            
            });
    



            $("#filtaño").change(function(){

             datos.splice(0);
             $("#meses option").removeAttr("selected");
             $("#meses option[value='0']").attr("selected", true);
               

                let sum=0;
               let año= $(this).val();  
               let datos1;
                 let sumar=0;
               
             datos1=datosAño;
     
           
              for(let i=0;i<datos1.length;i++){
                 if(datos1[i].innerHTML!=año){   //datos1 es una variable que recibe o que hace referencia a los datos de la columna 4 de la tabla (años), es decir los años
                 datos1[i].parentNode.remove();    //si el texto de esa columna o td es distinto al año (2020,2021,2022) que escojo en el select
                                                    //entonces remuevo o elimino el padre de ese td, es decir, todo la fila o tr
                 
                } else{   //sino, es decir, si el año que escogi en el select se encuentra en esa columna, me traigo la cantidad que se encuentra en la columna 2, esto es para ir sumando la cantidad de las filas que cumplen el filtro
                    let cadena=((datos1[i].parentNode.children[1].innerHTML).substr(1)).replace(/[.]/gi, "");
                   sum+= parseInt(cadena);
                   datos.push(datos1[i]);
                   
                 }
               }
                $("#tot").val("$" + formatNumber.new(sum));   //asigno al campo total amarillo la suma de todos los que cumplieron el filtro

//la variable datos es una variable global que viene de el change de rubro
//esto lo hago para que al modificar el año y se elimen filas de la tabla, aun se mantengan las filas del rubro
//es decir, que al modificar el año no se elimina todas las filas, sino que las guado en la variable datos
// hasta que el select rubro cambie.

               for(let i=0; i<datosAño.length;i++){ //datosAño solo se modiica cuando rubro o detalle cambian de opcion
                if(datosAño[i].innerHTML==año){       //por lo tanto, cuando select de año se modifica, uso esta variable para agregar a la tabla los registros
                    $("#report ").append(datosAño[i].parentNode);
                    }
               }



               if(año==="0"){
                for(let i=0; i<datosAño.length;i++){
                     $("#report").append(datosAño[i].parentNode);
                     let cade=((datosAño[i].parentNode.children[1].innerHTML).substr(1)).replace(/[.]/gi, "");
                     sumar+=parseInt(cade);
                }
                     $("#tot").val("$" + formatNumber.new(sumar));
               }


            });






            $("#meses").change(function(){
            

              if($("#filtaño").val()==="0")return;

                let sum=0;
               let mes= $(this).val();  
               let datosa;
               let sum2=0;
             datosa=datos;  //datos es una variable global que viene del select de año, esto se hace para traerme los registros que tengan el año que ya esta seleccionado, y de ahi sacar los meses
     
             if(mes==="0"){
              for(let i=0; i<datos.length;i++){
                   $("#report tbody").append(datos[i].parentNode);   
                   let cad=((datos[i].parentNode.children[1].innerHTML).substr(1)).replace(/[.]/gi, "");
                   sum2+=parseInt(cad);
              }

              $("#tot").val("$" + formatNumber.new(sum2)); 
              return;
             }



            
              for(let i=0;i<datosa.length;i++){
                  
                 if(datosa[i].parentNode.children[2].innerHTML!=mes){
                 datosa[i].parentNode.remove();  
                
                 } else{
                     
                  
                    let cadena=((datosa[i].parentNode.children[1].innerHTML).substr(1)).replace(/[.]/gi, "");
                   sum+= parseInt(cadena);
                   
                 }
               }
                $("#tot").val("$" + formatNumber.new(sum));  


               for(let i=0; i<datos.length;i++){
                if(datos[i].parentNode.children[2].innerHTML==mes){
                    $("#report tbody").append(datos[i].parentNode);
                    }
               }


                
                      
            });






} );