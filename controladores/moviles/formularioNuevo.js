var NuevoMovil = {

	init: function(){
   
   	urlNuevo = "moviles/nuevo.php";
   	urlModificar = "moviles/modificar.php";   

      $("#btnGuardar").click(function(){

      	var form = $(".form").serialize();

         $.ajax({
         	type: 'post',
            url: urlNuevo, 
            data: form,           
            dataType: 'html',
            beforeSend: function(){
                           
            },   
            success: function(data) {
            	var datos = data;
               if(datos != "OK"){
               	notificacion("error",data);      
               }else{
               	notificacion("success", "Móvil guardado correctamente");
                  $(".form-control").val('');
               }                         
             },
             error: function(a,b,c){
             	console.log(a);
               console.log(b);
               console.log(c);         
             }
          });

       });
       
       $("#btnModificar").click(function(){

                    var form = $(".form").serialize();
                
                    form += "&id="+_id;
                    $.ajax({
                        type: 'post',
                        url: urlModificar, 
                        data: form,           
                        dataType: 'html',
                        beforeSend: function(){
                           
                        },   
                        success: function(data) {
                            var datos = data.split("_");
                            if(datos[0] != "OK"){
                                notificacion("error",data);      
                            }else{
                                notificacion("success", "Móvil guardado correctamente");
                                $(".form-control").val('');
                            }                         
                        },
                        error: function(a,b,c){
                            console.log(a);
                            console.log(b);
                            console.log(c);         
                        }


                    });


                });
	}
}