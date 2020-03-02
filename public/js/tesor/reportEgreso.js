

$(document).ready(function(){

    var datosAño;
    var datosMeses;
    var datosTotales;
    var dat=[];
//cuando cambia el select del Rubro, mando el id y me traigo los detalles y a la vez me traigo los registros agruapados para la tabla
    $("#rubE").change(function(){
        $("#filtañoEgreso option").removeAttr("selected");
        $("#filtañoEgreso option[value='0']").attr("selected", true);

        
        $("#mesesE option").removeAttr("selected");
        $("#mesesE option[value='0']").attr("selected", true);

        let id= $(this).val();

        $.get("/tesor/movimientos/registros/egresos/rubro/" + id, 
        
            function(data){
                let total=0;
            //para poner los detalles en el select detallE, dependiendo la opcion del rubro
                if(data.detalles.length>0){
                    $("#detallE").empty();
                    $("#detallE").append('<option value="0">Selecciona un Detalle</option>');
                   
                     $.each(data.detalles,function(key,value){
                   
                   $("#detallE").append('<option value="'+value.id+'">'+ value.nombre.toUpperCase()+'</option>');
                      
                });
                 }
                 else{
                     $("#detallE").empty();
                     $("#detallE").append('<option value="0">Selecciona un Detalle</option>');
                 }


                   //para poner los registros agrupados por rubro, detalle, año y mes, con su total
                 if(data.registros.length>0){
                    $("#reportEg tbody tr").remove();
                    $("#reportEg str").remove();
                   
                  //  if(!$("#deta-en").length){  //al escoger una opcion del select detalle, quito una columna de la tabla(columna detalle)
                                                //entonces, si ese th o columna no existe o ya esta eliminado, creo de nuevo esa columna
                    //    $("#report tr:first").prepend('<th id="deta-en">' + "Detalle" + "</th>");
                   // }
                   
                    $.each(data.registros,function(key,value){
                         total+=value.total
                        $('#reportEg ').append('<tr class="p-3 text-capitalize"><td>' + value.detalle + '</td><td>' + formatNumber.new(value.total , "$") +  '</td><td>' + value.mes +  '</td><td>' + value.año + '</td></tr>');
                         });
                          
                         $("#tot").val('$ ' + formatNumber.new(total));
        
                         if(!$("#reportEg  #descargaE").length){
                            $("#reportEg").append('<a data-colu=' +id  + ' class="m-3"' + ' href="#"' + ' id="descargaE"' + '>' + "Reporte.pdf"  +'</a>')
                           // $( "#descargaDet").remove();
                         }else{
                           
                           $( "#reportEg #descargaE" ).attr("data-colu", id );
                           $( "#descargaDetalle").remove();
                         }
                        
        
                  }else{
                      $( "#descargaE ").remove();
                      $( "#descargaDetalle ").remove();
                      $('#reportEg strong').remove();
                    $("#reportEg tbody tr").remove();
                    $('#reportEg ').append('<tr class="str"><td class="sin"><strong>' + "Sin resultados " + '</strong></td>' + '<td class="sin"></td>' + '<td class="sin"></td>'+ '<td class="sin"></td>' +'</tr>');
                    $("#tot").val("0");
                  }
                 datosTotales=$("#reportEg tr  td:nth-child(1)");
                  datosAño= $("#reportEg tr td:nth-child(4)");   //columna donde estan los años, ultima columna
                  datosMeses= $("#reportEg tr td:nth-child(3)");  //columna donde estan los meses, tercer columna

        },'json'
        ). fail(function(){

        });

    });


//cundo le doy click a reporte.pdf para rubror
    $(document).on('click', "#descargaE ", function(e){
        e.preventDefault();
    let id=e.target.attributes["data-colu"].nodeValue;
    let ano=$("#filtañoEgreso").val();
    let mes=$("#mesesE").val();

    if(ano==="0"){  
          //como el parametro año es opcional, cuando ano==="0" es porque no ha escogido ningun año, entonces lo mando sin año y en el controlador se especifica que use el año actual
         if(mes==="0"){
            window.open("http://127.0.0.1:8000/tesor/movimientos/reportes/pdfRubro/" + id   );
          }else{
            window.open("http://127.0.0.1:8000/tesor/movimientos/reportes/pdfRubro/" + id + "/" + "2" + "/" + mes  );
          }
   
}else if(mes==="0"){
        window.open("http://127.0.0.1:8000/tesor/movimientos/reportes/pdfRubro/" + id + "/" + ano );
    }else{
        window.open("http://127.0.0.1:8000/tesor/movimientos/reportes/pdfRubro/" + id + "/" + "2" + "/" +  mes ); 
    }
  
    
    });


    $(document).on('click', "#descargaDetalle ", function(e){
        e.preventDefault();
        let id=e.target.attributes["data-id"].nodeValue;
        let id_rub=$("#rubE").val();
         let ano=$("#filtañoEgreso").val();
         if(ano=="0"){
            window.open("http://127.0.0.1:8000/tesor/movimientos/reportes/pdfDetalle/" + id + '/' + id_rub );
  
         }else{
            window.open("http://127.0.0.1:8000/tesor/movimientos/reportes/pdfDetalle/" + id + '/' + id_rub + "/" + ano );
  
         }
       
    
    });


//cuando hago cambio en el select detalle modifico los datos de la tabla
    $("#detallE").change(function(){

    $("#filtañoEgreso option").removeAttr("selected");
        $("#filtañoEgreso option[value='0']").attr("selected", true);

        $("#mesesE option").removeAttr("selected");
        $("#mesesE option[value='0']").attr("selected", true);

        let id_rub=$("#rubE").val();
        let id= $(this).val();

     console.log(datosTotales[0].parentNode);
        if(id=="0"){
            
          $("#reportEg tbody tr").remove();
            $( "#descargaDetalle").remove();
             
            for(let i=0;i<datosTotales.length;i++){
            $("#reportEg").append(datosTotales[i].parentNode);
            }

            return;
        }
      
            $.get('/tesor/movimientos/registros/egresos/rubro/detalle/'+ id_rub + '/' + id ,
            function( data, textStatus, jQxhr ){    
               
    
              if(data.registros.length>0){
                $("#reportEg td").remove();
                $("#reportEg strong").remove();
              //  $("#report #deta-en").remove();  //elimino la columna Detalle de la tabla
                let total=0
                $.each(data.registros,function(key,value){
                    total+=value.total
                    $('#reportEg').append('<tr><td>'  + value.detalle + '</td><td>' + formatNumber.new(value.total , "$") +  '</td><td>' + value.mes +  '</td><td>' + value.año + '</td></tr>');
                     });

                     $("#tot").val("$" + formatNumber.new(total));

                     if(!$("#reportEg  #descargaDetalle").length){
                       $("#reportEg").append('<a data-id=' +id  +  ' href="#"' + 'class="m-3"' + ' id="descargaDetalle"' + '>' + "ReporteDetalle.pdf"  +'</a>')
                    
                     }else{
                       
                       $( "#reportEg #descargaDetalle" ).attr("data-id", id );
                     }
    
              }else{
                $( "#descargaDetalle").remove();
                $("#reportEg td").remove();
                $('#reportEg').append('<strong>' + "Sin resultados " + '</strong>');
              }
          
              
             datosAño= $("#reportEg tr td:nth-child(4)"); 
              datosMeses= $("#reportEg tr td:nth-child(3)"); 
             
            },
            'json'
        )
            .fail(function( xhr, textStatus, errorThrown ){
      //console.log(xhr);
            });
        


    });  




    $("#filtañoEgreso").change(function(){
   dat.splice(0)
        $("#mesesE option[value='0']").attr("selected", false);
        $("#mesesE option[value='0']").attr("selected", true);

                let sum=0;
                let sum1=0;
               let año= $(this).val();  
               let datos1;
   
               
             datos1=datosAño;
     
           
              for(let i=0;i<datos1.length;i++){
                 if(datos1[i].innerHTML!=año){   //datos1 es una variable que recibe o que hace referencia a los datos de la columna 4 de la tabla (años), es decir los años
                 datos1[i].parentNode.remove();    //si el texto de esa columna o td es distinto al año (2020,2021,2022) que escojo en el select
                                                    //entonces remuevo o elimino el padre de ese td, es decir, todo la fila o tr
                 
                } else{   //sino, es decir, si el año que escogi en el select se encuentra en esa columna, me traigo la cantidad que se encuentra en la columna 2, esto es para ir sumando la cantidad de las filas que cumplen el filtro
                    let cadena=((datos1[i].parentNode.children[1].innerHTML).substr(1)).replace(/[.]/gi, "");
                   sum+= parseInt(cadena);
                   dat.push(datos1[i]);
                   
                 }
               }
                $("#tot").val("$" + formatNumber.new(sum));   //asigno al campo total amarillo la suma de todos los que cumplieron el filtro

//la variable datos es una variable global que viene de el change de rubro
//esto lo hago para que al modificar el año y se elimen filas de la tabla, aun se mantengan las filas del rubro
//es decir, que al modificar el año no se elimina todas las filas, sino que las guado en la variable datos
// hasta que el select rubro cambie.

               for(let i=0; i<datosAño.length;i++){ //datosAño solo se modiica cuando rubro o detalle cambian de opcion
                if(datosAño[i].innerHTML==año){       //por lo tanto, cuando select de año se modifica, uso esta variable para agregar a la tabla los registros
                    $("#reportEg ").append(datosAño[i].parentNode);
                   
                    }
               }

               if(año==="0"){  //recordemos que datosaño es un variable global que tiene todos los registros, solo cuando se modifica select rubro y detalle.
               for(let i=0; i<datosAño.length;i++){ //datosAño solo se modiica cuando rubro o detalle cambian de opcion
                     //por lo tanto, cuando select de año se modifica, uso esta variable para agregar a la tabla los registros
                    $("#reportEg ").append(datosAño[i].parentNode);
                   let cade=((datosAño[i].parentNode.children[1].innerHTML).substr(1)).replace(/[.]/gi, "");
                    sum1+=parseInt(cade);
                    }

                    $("#tot").val("$" + formatNumber.new(sum1));
                }

              




    });



    $("#mesesE").change(function(){

       if($("#filtañoEgreso").val()==="0")return;


             let mes= $(this).val();
let sum=0;
         let datosA= dat;  //dat es una variable global que trae los registros que tiene actualmente el año seleccionado, viene del select de año
       //  let datosM= datosMeses;

       if(mes==="0"){
        for(let i=0; i<dat.length;i++){
            $("#reportEg tbody").append(dat[i].parentNode);   
            let cad=((dat[i].parentNode.children[1].innerHTML).substr(1)).replace(/[.]/gi, "");
            sum+=parseInt(cad);
        
       }

       $("#tot").val("$" + formatNumber.new(sum)); 
       return;
       }


         for(let i=0;i<datosA.length;i++){
            if(datosA[i].parentNode.children[2].innerHTML!=mes){   
            datosA[i].parentNode.remove();    
            
           } else{  
               let cadena=((datosA[i].parentNode.children[1].innerHTML).substr(1)).replace(/[.]/gi, "");
              sum+= parseInt(cadena);
              
            }
          }

          $("#tot").val("$" + formatNumber.new( sum));



          for(let i=0; i<dat.length;i++){
            if(dat[i].parentNode.children[2].innerHTML==mes){
                $("#reportEg tbody").append(dat[i].parentNode);
                }
           }




             

    })
});