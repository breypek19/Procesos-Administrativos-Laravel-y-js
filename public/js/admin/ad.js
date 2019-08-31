$( document ).ready(function() {
 
    $("li.nave a").click(function(e){
          
          //  let elem=$(this).attr("id");   //me traigo el el valor del atributo id

               

             $(this).addClass("click");
             $(li).not(this).removeClass("click");  //remuevo la clase click de todos los links, excepto al que se le dio click
            // e.preventDefault();   
                 
            })
           
});



