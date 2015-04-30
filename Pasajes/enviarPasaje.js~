var EnviarPasaje = {

	init: function(){
			
			$("#btnAsignar").click(function(){
				
			urlpasajeGCM = "../Pasajes/pasajeGCM.php";
			urlNuevoPasaje = "../Pasajes/nuevo.php";
			
			var form = $(".form").serialize();

		$.ajax({
                        type: 'post',
                        url: urlNuevoPasaje, 
                        data: form,           
                        dataType: 'html',
                        beforeSend: function(){
                           
                        },   
                        success: function(data) {
									var datos = data.split("_");
               				if(datos[0] != "OK"){
               					//notificacion("error",data); 
               					alert(data);     
               				}else{
               					//window.location.replace("panelSitio.php?subSeccion=NuevoChofer");
               					alert("Pasaje enviado correctamente"); 
               					//notificacion("success", "Pasaje enviado correctamente");
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