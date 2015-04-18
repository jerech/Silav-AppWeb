var Modulo = {
    init : function(){
    	$("#btnGeolocalizacion").click(function(){
$('#choferes').text(1);
    		$.ajax({
                            type: 'POST',
                            url: 'usuarios/mapaActivo.php',
                            data:{
                                usuario: usuarioNombre
                            },
                            dataType: 'html',
                            success: function(data){
        
                                if (data == "si") {
                                    notificacion("error","Error al intentar ingresar al Mapa. ");
            
                                }else{
                                	setMapaActivo();
                                    window.open("../Geolocalizacion/paginaMapa.php","_blank");
                                }

                            },
                        });
    	});

        setMapaActivo = function(){
        $.ajax({
                        type: 'POST',
                        url: 'usuarios/setMapaActivo.php',
                        data:{
                            usuario: usuarioNombre
                        },
                        dataType: 'html',
                        success: function(data){

                        },
                    });
    }
    
    $("#btnControlDePasajes").click(function(){

    		$.ajax({
                            type: 'POST',
                            url: 'usuarios/controlDePasajesActivo.php',
                            data:{
                                usuario: usuarioNombre
                            },
                            dataType: 'html',
                            success: function(data){
        
                                if (data == "si") {
                                    notificacion("error","Error al intentar ingresar al Control de Pasajes. ");
            
                                }else{
                                	setMapaActivo();
                                    window.open("../Pasajes/controlDePasajes.php","_blank");
                                }

                            },
                        });
    	});

		setControlDePasajesActivo = function(){
        $.ajax({
                        type: 'POST',
                        url: 'usuarios/setControlDePasajesActivo.php',
                        data:{
                            usuario: usuarioNombre
                        },
                        dataType: 'html',
                        success: function(data){

                        },
                    });
    }

    }



	

	
}