var NuevoChofer = {

	init: function(){
   
   	urlNuevo = "choferes/nuevo.php";
   	urlModificar = "choferes/modificar.php";
   	urlObtenerMovilesAsignados = "choferes/obtenerMovilesAsignados.php";   

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
			
			var arraySerializado = "";
			if (typeof(idMovilesSeleccionados) === "undefined"){
				
			}
			else {
				for (i=0 ; i<idMovilesSeleccionados.length ; i++) {
					arraySerializado += "&";
					arraySerializado += "idMovilesSeleccionados";
					arraySerializado += "%5B%5D=" + idMovilesSeleccionados[i];
				}
				form += arraySerializado;
			}

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
               	//window.location.replace("panelSitio.php?subSeccion=NuevoChofer");
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

		var contrasenia = $("#contrasenia").val();
         var reContrasenia = $("#re-contrasenia").val();

         var contraseniaEncriptada = hex_md5(contrasenia);
         $("#contrasenia-encriptada").val(contraseniaEncriptada);
         var reContraseniaEncriptada = hex_md5(reContrasenia);
         $("#re-contrasenia-encriptada").val(reContraseniaEncriptada);

         $("#contrasenia").val("");
         $("#re-contrasenia").val("");

		//movilesAsignadosBD: array con los ids de los moviles asignados a un chofer, almacenados en la base de datos
		//movilesAsignadosModificados: array con los ids de los moviles asignados a un chofer, despues de la modificacion
		var movilesAsignadosModificados = new Array();
		var movilesParaEliminar = new Array();
		var movilesParaAgregar = new Array();		
		var contadorParaEliminar = 0;
		var contadorParaAgregar = 0;
		
		var form = $(".form").serialize();		
		form += "&id="+_id;
		
		var cont = 0;
		$('#tabla tr td').each(function () {

		if (typeof($(this).attr('id')) != 'undefined') {
			movilesAsignadosModificados[cont] = $(this).attr('id');
			cont = cont + 1;
		}

		});                    

     	if (movilesAsignadosBD.length == 0) {
     		if (movilesAsignadosModificados.length == 0) {
     			//no hacer nada (no hay moviles asignados en ningun lado)
     			form += "&asignacion=sinAsignaciones";
     			
     			modificarBD(form);
     		}
     		else {
     			//agregar todos los moviles que estan en el array movilesAsignadosModificados
     			form += "&asignacion=agregarAsignaciones";
     			var formulario = serializarArray(form, movilesAsignadosModificados, "movilesParaAgregar");
     			
     			modificarBD(formulario);
     		}
     	}
     	else {
     		if (movilesAsignadosModificados.length == 0) {
     			//borrar todos los moviles asignados que estan en la base de datos
     			form += "&asignacion=borrarAsignaciones";
     			
     			modificarBD(form);
     		}
     		else {
     			//comparar cambios en los dos arrays
     			var movilEncontrado = false;
     			//comprobar los moviles a eliminar
     			for (i=0 ; i<movilesAsignadosBD.length ; i++) {
     				for (j=0 ; j<movilesAsignadosModificados.length ; j++) {
     					
     					if (movilesAsignadosBD[i] == movilesAsignadosModificados[j]) {
     						movilEncontrado = true;
     					}
     				}
     				if (movilEncontrado == false) {
     					movilesParaEliminar[contadorParaEliminar] = movilesAsignadosBD[i];
     					contadorParaEliminar = contadorParaEliminar + 1;
     				}
     				else {
     					movilEncontrado = false;
     				}
     			}
     			//comprobar los moviles a agregar
     			movilEncontrado = false
     			for (i=0 ; i<movilesAsignadosModificados.length ; i++) {
     				for (j=0 ; j<movilesAsignadosBD.length ; j++) {
     					
     					if (movilesAsignadosModificados[i] == movilesAsignadosBD[j]) {
     						movilEncontrado = true;
     					}
     				}
     				if (movilEncontrado == false) {
     					movilesParaAgregar[contadorParaAgregar] = movilesAsignadosModificados[i];
     					contadorParaAgregar = contadorParaAgregar + 1;
     				}
     				else {
     					movilEncontrado = false;
     				}
     			}
     			if (movilesParaAgregar.length == 0 && movilesParaEliminar.length == 0) {
     				var formulario = form+"&asignacion=sinAsignaciones";
     			}
     			else{
     				form += "&asignacion=modificarAsignaciones";
     				var formulario = serializarArray(form, movilesParaAgregar, "movilesParaAgregar");
     				formulario = serializarArray(formulario, movilesParaEliminar, "movilesParaEliminar");
     			}
     			
     			modificarBD(formulario);
     		}	
     		
     	}
     	
                });
	}
}
function modificarBD(formulario) {
	  
	$.ajax({
                        type: 'post',
                        url: urlModificar, 
                        data: formulario,           
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
}

function serializarArray(formulario, arrayDatos, nombreArray) {
	
	if (arrayDatos.length == 0) {
		formulario += "&";
		formulario += nombreArray;
		formulario += "%5B%5D=" + "0";
	}
	else {
		for (i=0 ; i<arrayDatos.length ; i++) {
			formulario += "&";
			formulario += nombreArray;
			formulario += "%5B%5D=" + arrayDatos[i];
		}	
	}
	return formulario;
}