var CargarDatos = {

	init: function(){
			
			var urlObtenerPasajes = "../Pasajes/obtenerPasajesEnCurso.php";
			var urlObtenerChoferes = "../Pasajes/obtenerChoferes.php";
			
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
                        	nuevaFila += "<td>"+data.pasajes[index].estado+"</td>";
                        	
                        	nuevaFila += "</tr>";
                        	
                        	$("#tablaPasajes").append(nuevaFila);
                        	
                        	if (data.pasajes[index].estado == "por_asignar") { 
                        		$("#"+data.pasajes[index].id).css("background-color", "#f00");
                        	}
                        	else {
                        		if (data.pasajes[index].estado == "asignado") {
                        			//insertar color para estado ASIGNADO
                        		}
                        		else {
                        			if (data.pasajes[index].estado == "terminado") {
                        				//insertar color para estado TERMINADO
                        			}
                        			else {
                        				if (data.pasajes[index].estado == "rechazado") {
                        					//insertar color para estado RECHAZADO
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
                    
      $.ajax({
                        type: 'post',
                        url: urlObtenerChoferes, 
                        data: {},           
                        dataType: 'json',
                        beforeSend: function(){
                           
                        },   
                        success: function(data) {
                        $('#listaChoferes').empty();
                        
								choferesConectados = data;
								var contador = 0;
								$(data.choferes).each(function(index){
	
                           contador = contador + 1;
                           
                           var nuevaOpcion = "<option ";
                           
									if (contador == 1) {
										nuevaOpcion += " selected='selected' ";
										$("#movil").val(data.choferes[index].numero_movil);
									}
									
									nuevaOpcion += "value="+data.choferes[index].usuario+">"+data.choferes[index].usuario+"</option>";
									
									$('#listaChoferes').append(nuevaOpcion);                           
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