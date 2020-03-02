$(function(){
    
    


      $('.myCalendar').calendar({
        
        select:function(date) {
         
            $("#modalAsistencia").modal("show");
      
            $('input[type="text"]').val("");
            $("#fecha").val("");
            $(".prom").remove();
            $(".tot").remove();
            $(".prom_can").remove();
            $("#fecha").val(date);
           

         
            let d=new Date(date)
            let year=d.getFullYear();
            let mes=d.getMonth();  //getMonth() me trae los meses de 0 a 11, comenzando enero desde el 0 y diciembre 11
             let dia=d.getDate();  
             let dia_semana=d.getDay(); //da el dia de la semana como un numero de 0 a 6 comenzando desde el domingo 0, lunes 1, etc..
                                        
            $.get("/secre/Asis/verificar/" + year + "/" + mes + "/" + dia + "/" + dia_semana,
             function(success){
               
                 if(success.fila.length>0){  //SI YA HAY EN LA BD REGISTRO DE LA ASISTENCIA DE ESE DIA
                     $(".ingreAsis").remove(); //texto que dice: ingrese asistencia
                     $("#guardarAsis").hide();  //escondo el boton de guardar, ya que solo quiero mostrar o listar la asistencia de ese dia
              
               
               $("#hermanos").val(success.fila[0].canti_hermanos);  //me pongo a listar las cantidades de la bd en los campos
            $("#hermanas").val(success.fila[0].canti_hermanas);
          $("#visitas").val(success.fila[0].canti_visitas);
             $("#niños").val(success.fila[0].canti_niños);

             //aqui saco la suma total de asisentes para ese dia en particular
let suma=parseInt(success.fila[0].canti_hermanos) + parseInt(success.fila[0].canti_hermanas)+ 
parseInt(success.fila[0].canti_visitas) + parseInt(success.fila[0].canti_niños) ;

  let dia_seman;
  let mes;

  let meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", 
  "Julio", "Augosto", "Septiembre",  "Octubre", "Noviemre", "Diciembre"];

  let dias = ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", 
  "Sabado"];

  dia_seman = dias[success.promedio[0].dia_semana];
  mes = meses[success.promedio[0].mes];
 
        
//ademas de la lista de la asistencia de ese dia en particular, desde la bd me traigo el total promedio para ese dia de la semana (lunes, martes , miercoles, etcc..)
let total_prom=parseInt(success.promedio[0].hermanos)+ parseInt(success.promedio[0].hermanas)+parseInt(success.promedio[0].visitas)+parseInt(success.promedio[0].niños);
     
                   $(".fec").append('<div class="col-sm-5 col-md-5 prom text-center" ><h5 class="text-danger" >Promedio dias ' + dia_seman + " " + "mes de " +   mes +'</h5></div>');

                  $(".niñ").after('<div class="row form-group tot"><div class="col-sm-7 col-md-7"> Total: ' + suma +  ' </div></div>');
           
                  $(".herma").append('<div class="col-sm-5 col-md-5 prom_can" >Promedio Hnos: ' + success.promedio[0].hermanos +'</div>');
                  $(".herman").append('<div class="col-sm-5 col-md-5 prom_can" >Promedio Hnas: ' + success.promedio[0].hermanas +'</div>');
                  $(".vis").append('<div class="col-sm-5 col-md-5 prom_can" >Promedio Visitas: ' + success.promedio[0].visitas +'</div>');
                  $(".niñ").append('<div class="col-sm-5 col-md-5 prom_can" >Promedio niños: ' + success.promedio[0].niños +'</div>');
                  $(".tot").append('<div class="ml-5 ml-md-0 col-sm-5 col-md-5 prom_can" >Promedio Total: ' + total_prom +'</div>');

                  $('input[type="text"].asis').prop("disabled", true); //desabilito todos los input text con clase .asis para que no cambien nada

                 }else{                   //sino hay registros de la bd, quiere decir que no se ha guardado ninguna asistencia de ese dia
                    $("#guardarAsis").show();  //muestro el boton guardar por si quiero agregar la asistencia ese dia
                    $(' input[type="text"].asis').prop("disabled", false);  //habilito los inpu text con clase .asis
                   if(!$(".ingreAsis").length){
                    $(".fec").before('<div class="mb-3 text-danger ingreAsis"> Ingrese la Asistencia</div>')
                   }
                }
               
             }
             ).fail(function(error){
                console.log(error);
             });

            

        }
  
      });


      $(".myCalendar th").click(function(){
          console.log($(this));
      })



      $("#guardarAsis").click(function(){
         
        let d=new Date($("#fecha").val());
        
       
             let year=d.getFullYear();
             let mes=d.getMonth();  //getMonth() me trae los meses de 0 a 11, le sumo 1 para que sea de 1 a 12
              let dia=d.getDate();
             let dia_semana= d.getDay();
             let hnos= $("#hermanos").val();
             let hnas= $("#hermanas").val();
             let visitas= $("#visitas").val();
             let ninos= $("#niños").val();
            

             if(hnos=="" || hnas=="" || visitas=="" || ninos=="" ){
              return;
             }
  
           

            $.post("/secre/Asistencias", 
            {herm:hnos, hermanas:hnas, visi:visitas, nin:ninos,
                año:year, me:mes, di:dia, dia_seman:dia_semana
            }
            , function(success){
              
              $("#success").append('<div  class="alert alert-danger mens" role="alert">'+ success.mensaje + "</div>")
              
              setTimeout(function(){
                $(".mens").remove();
               }, 1500);
              

              $('input[type="text"]').val("");
               $("#fecha").val("");

            } 
            ). fail(function(){

            });
        
           
      });

      



    });
    

    