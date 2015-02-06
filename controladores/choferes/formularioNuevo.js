var NuevoChofer = {

	init: function(){
   
   	urlNuevo = "choferes/nuevo.php";
   	urlModificar = "choferes/modificar.php";   

      $("#btnGuardar").click(function(){

			var contrasenia = $("#contrasenia").val();
         var reContrasenia = $("#re-contrasenia").val();

         var contraseniaEncriptada = hex_md5(contrasenia);
         $("#contrasenia-encriptada").val(contraseniaEncriptada);
         var reContraseniaEncriptada = hex_md5(reContrasenia);
         $("#re-contrasenia-encriptada").val(reContraseniaEncriptada);

         $("#contrasenia").val("");
         $("#re-contrasenia").val("");

      	var form = $(".form").serialize();

         $.ajax({
         	type: 'post',
            url: urlNuevo, 
            data: form,           
            dataType: 'html',
            beforeSend: function(){
                           
            },   
            success: function(data) {
            	var datos = data.split("_");;
               if(datos[0] != "OK"){
               	notificacion("error",data);      
               }else{
               	notificacion("success", "Chofer guardado correctamente");
                  $(".form-control").val('');

               }                         
             },
             error: function(a,b,c){
             	alert("error");
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
                                notificacion("success", "Chofer guardado correctamente");
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