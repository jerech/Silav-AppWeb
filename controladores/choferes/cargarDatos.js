var CargarDatos = {

	init: function(){

		urlObtenerDatos = "choferes/obtenerPorId.php";
		urlObtenerMovilesAsignados = "choferes/obtenerMovilesAsignados.php";

		$.ajax({
                        type: 'post',
                        url: urlObtenerDatos, 
                        data: {
                            'id': _id
                        },           
                        dataType: 'json',
                        beforeSend: function(){
                           
                        },   
                        success: function(data) {

                            $("#nombre").val(data.choferes[0].nombre);
                            $("#apellido").val(data.choferes[0].apellido);
                            $("#usuario").val(data.choferes[0].usuario);
                            $("#numero_telefono").val(data.choferes[0].numero_telefono);
                            $("#venc_licencia").val(data.choferes[0].venc_licencia);

                            if(data.choferes[0].sexo == "0"){
                            	
                                $("[name='sexo']").bootstrapSwitch.checked('false');
                            }
									 if(data.choferes[0].habilitado == "0"){
                            	
                                $("[name='habilitado']").bootstrapSwitch.checked('false');
                            }

                                                     
                        },
                        error: function(a,b,c){
                            console.log(a);
                            console.log(b);
                            console.log(c);         
                        }


                    });
               
      $.ajax({
                        type: 'post',
                        url: urlObtenerMovilesAsignados, 
                        data: {
                            'id': _id
                        },           
                        dataType: 'json',
                        beforeSend: function(){
                           
                        },   
                        success: function(data) {
                        	var contador = 0;
                        	$(data.movilesAsignados).each(function(index){

                        	 
								
								                           
                        });
									
                                                     
                        },
                        error: function(a,b,c){
                        	alert("dfd");
                            console.log(a);
                            console.log(b);
                            console.log(c);         
                        }


                    });

	}
}
/*contador = contador + 1;
                           
                           var nuevaFila = "<tr>";
		
									nuevaFila += "<td>"+contador+"</td>";
									nuevaFila += "<td>"+data.movilesAsignados[index].numero+"</td>";
									nuevaFila += "<td>"+data.movilesAsignados[index].patente+"</td>";
									nuevaFila += "<td>"+data.movilesAsignados[index].modelo+"</td>";
									nuevaFila += "<td>"+data.movilesAsignados[index].marca+"</td>";

									nuevaFila += "<td>";
									nuevaFila += "<a href='panelSitio.php?subSeccion=ModificarMovil&id="+data.movilesAsignados[index].id+"'><i class='fa fa-pencil'></i></a>";
      							nuevaFila += " <a href='#myModal' onclick='guardarId("+data.movilesAsignados[index].id+");' class='boton_eliminar' id='"+data.movilesAsignados[index].id+"' name='boton_eliminar' role='button' data-toggle='modal'><i class='fa fa-trash-o'></i></a>";
      							nuevaFila += "</td>";
		
									nuevaFila +="</tr>";
		
									$("#tabla").append(nuevaFila);*/