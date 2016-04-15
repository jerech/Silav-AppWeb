var Modulo = {
    init : function(){
    	$("#btnGeolocalizacion").click(function(){

if (typeof(ventanaGeolocalizacion) === "undefined") {
    		ventanaGeolocalizacion = window.open("../Geolocalizacion/paginaMapa.php","_blank");
    	}
    	else {
			if(ventanaGeolocalizacion.closed){
				ventanaGeolocalizacion = window.open("../Geolocalizacion/paginaMapa.php","_blank");
			}
			else{
				notificacion("error","Error al intentar ingresar al Mapa. ");
			}
		}

    	});
    
    $("#btnControlDePasajes").click(function(){
    	
    	if (typeof(ventanaControlDePasajes) === "undefined") {
    		ventanaControlDePasajes = window.open("../Pasajes/controlDePasajes.php","_blank");
    	}
    	else {
			if(ventanaControlDePasajes.closed){
				ventanaControlDePasajes = window.open("../Pasajes/controlDePasajes.php","_blank");
			}
			else{
				notificacion("error","Error al intentar ingresar al Control de Pasajes. ");
			}
		}

    	});

    }
}

var MostrarInformacionResumen = {
	init : function(){
		$.ajax({
                        type: 'POST',
                        url: 'inicio/obtenerInformacionResumen.php',
                        data:{
                            usuario: usuarioNombre
                        },
                        dataType: 'json',
                        success: function(data){
                            console.log(data);
                        	
                        	var divisionPorGuion = data[0].toString().split("_"); //separa por guion
									var conectados = divisionPorGuion[0];
									var choferes = divisionPorGuion[1];
									var pasajesEnCurso = divisionPorGuion[2];
									
									$('#choferes').text(choferes);
									$('#pasajes').text(pasajesEnCurso);
									$('#conectados').text(conectados);

                            if(data[1]!=false){
                                var chofer=data[1];
                                alert("Atencion!! Chofer "+chofer['usuario']+" ha enviado una alerta SOS.");
                            }
                            
                        },
                        error: function(a,b,c){
                            alert("error");        
                        }
                    });		
		
		var temporizador=setInterval(function(){
			
			$.ajax({
                        type: 'POST',
                        url: 'inicio/obtenerInformacionResumen.php',
                        data:{
                            usuario: usuarioNombre
                        },
                        dataType: 'html',
                        success: function(data){
                        	var divisionPorComillas = data.toString().split("\""); //separa por comillas
                        	var datos = divisionPorComillas[1];
                        	var divisionPorGuion = datos.toString().split("_"); //separa por guion
									var conectados = divisionPorGuion[0];
									var choferes = divisionPorGuion[1];
									var pasajesEnCurso = divisionPorGuion[2];
									
									$('#choferes').text(choferes);
									$('#pasajes').text(pasajesEnCurso);
									$('#conectados').text(conectados);
                        },
                        error: function(a,b,c){
                            alert("error");        
                        }
                    });
			
		},120000);
	}
}