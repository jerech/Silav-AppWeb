var CargarPasajesEnCurso = {

	init: function(){
			
			var urlObtenerPasajes = "../Pasajes/obtenerPasajesEnCurso.php";
			
			var temporizador=setInterval(function(){

			$.ajax({
                        type: 'post',
                        url: urlObtenerPasajes, 
                        data: {},           
                        dataType: 'json',
                        beforeSend: function(){
                           
                        },   
                        success: function(data) {
								
								$("#tablaPasajes > tbody:last").children().remove();
								
								$(data.pasajes).each(function(index){

									var nuevaFila = "<tr id='"+data.pasajes[index].id+"'>";
									
									nuevaFila += "<td>"+data.pasajes[index].fecha+"</td>";
                        	nuevaFila += "<td>"+data.pasajes[index].direccion+"</td>";
                        	nuevaFila += "<td>"+data.pasajes[index].nombreCliente+"</td>";
                        	nuevaFila += "<td>"+data.pasajes[index].usuarioChofer+"</td>";
                        	nuevaFila += "<td>"+data.pasajes[index].numeroMovil+"</td>";
                        	nuevaFila += "<td id='estado_"+data.pasajes[index].id+"'>"+data.pasajes[index].estado+"</td>";
                        	
                        	nuevaFila += "</tr>";
                        	
                        	$("#tablaPasajes").append(nuevaFila);
                        	
                        	if (data.pasajes[index].estado == "por_asignar") { 
                        		$("#estado_"+data.pasajes[index].id).css("background-color", "#F1FF69");
                        	}
                        	else {
                        		if (data.pasajes[index].estado == "asignado") {
                        			$("#estado_"+data.pasajes[index].id).css("background-color", "#69FF69");
                        		}
                        		else {
                        			if (data.pasajes[index].estado == "terminado") {
                        				//insertar color para estado TERMINADO
                        			}
                        			else {
                        				if (data.pasajes[index].estado == "rechazado") {
                        					$("#estado_"+data.pasajes[index].id).css("background-color", "#FF6969");
                        				}	
                        			}
                        		}
                        	}
                        });
                                                     
                        },
                        error: function(a,b,c){

                            console.log(a);
                            console.log(b);
                            console.log(c);         
                        }


                    });
			
		},5000);
	}
}