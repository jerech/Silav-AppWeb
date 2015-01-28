var Modulo = {
    init : function(){
    	$("#btnGeolocalizacion").click(function(){

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

    }

	

	
}