var mostrarDatos = {

	init: function(){

		var urlObtenerDatos = "estadisticas/obtenerPasajes.php";


		$.ajax({
					type: 'post',
                    url: urlObtenerDatos, 
                    data: {},           
                    dataType: 'json',
                    beforeSend: function(){
                        blockUI($("#div-tabla"), false);
                    },   
                    success: function(data) {
								      var contador = 0;
                        
                        $(data.pasajes).each(function(index){
                        	
                        	contador = contador + 1;
                           
                           var nuevaFila = "<tr>";
		
									nuevaFila += "<td>"+data.pasajes[index].id+"</td>";
									nuevaFila += "<td>"+data.pasajes[index].fecha+"</td>";
									nuevaFila += "<td>"+data.pasajes[index].usuario_chofer+"</td>";
									nuevaFila += "<td>"+data.pasajes[index].numero_movil+"</td>";
									nuevaFila += "<td>"+data.pasajes[index].nombre_cliente+"</td>";
                  nuevaFila += "<td>"+data.pasajes[index].direccion+"</td>";

                  switch(data.pasajes[index].estado){
                    case 'por_asignar':
                          nuevaFila += "<td style='background-color:#F1FF69'>"+data.pasajes[index].estado+"</td>";
                          break;
                    case 'asignado':
                          nuevaFila += "<td style='background-color:#69FF69'>"+data.pasajes[index].estado+"</td>";
                          break;
                    case 'rechazado':
                          nuevaFila += "<td style='background-color:#FF6969'>"+data.pasajes[index].estado+"</td>";
                          break;
                    default:
                          nuevaFila += "<td>"+data.pasajes[index].estado+"</td>";
                  }
                  
		
									nuevaFila +="</tr>";
		
									$("#tabla").append(nuevaFila);                            
                        });
      	            		initDataTable($('#tabla'));

      	            		unblockUI($("#div-tabla"));
       
                    },
                    error: function(a,b,c){
                    	unblockUI($("#div-tabla"));
                        console.log(a);
                        console.log(b);
                        console.log(c);  		
                    }

				});
			
			
}
}