var CargarDatos = {

	init: function(){

		urlObtenerDatos = "choferes/obtenerPorId.php";
		urlObtenerMovilesAsignados = "choferes/obtenerMovilesAsignados.php";
		urlObtenerMoviles = "choferes/obtenerMoviles.php";

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
                        	var movilesAsignados = new Array();
                        	
                        	
                        	$(data.movilesAsignados).each(function(index){
										movilesAsignados[contador] = data.movilesAsignados[index].id_movil;
										contador = contador + 1;                  
                        	});
                        	
									if (movilesAsignados.length > 0) {
										movilesAsignadosBD = movilesAsignados;
				$.ajax({
					type: 'post',
                    url: urlObtenerMoviles, 
                    data: {},           
                    dataType: 'json',
                    beforeSend: function(){
                        
                    },   
                    success: function(data) {
                        //var contadorFilas = 0;
                        $(data.moviles).each(function(index){
                        	for (i=0 ; i<movilesAsignados.length ; i++) {
                        		if (movilesAsignados[i] == data.moviles[index].id) {
                        			contadorFilas = contadorFilas + 1;
                           
                           var nuevaFila = "<tr>";
		
									nuevaFila += "<td>"+contadorFilas+"</td>";
									nuevaFila += "<td>"+data.moviles[index].numero+"</td>";
									nuevaFila += "<td>"+data.moviles[index].patente+"</td>";
									nuevaFila += "<td>"+data.moviles[index].modelo+"</td>";
									nuevaFila += "<td>"+data.moviles[index].marca+"</td>";

									nuevaFila += "<td id='"+data.moviles[index].id+"'>";
      							nuevaFila += "<a href='#myModal' onclick='guardarIdyNumero(this);' class='boton_eliminar' id='"+data.moviles[index].id+"' name='boton_eliminar' role='button' data-toggle='modal'><i class='fa fa-trash-o'></i></a>";
      							nuevaFila += "</td>";
		
									nuevaFila +="</tr>";
		
									$("#tabla").append(nuevaFila);
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
										
									}
                           else {
                           	movilesAsignadosBD = new Array();	
                           }                         
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
   								