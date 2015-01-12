$(document).ready(function(){
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

	function setMapaActivo(){
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

	function notificacion(op,msg,time){
            if(time == undefined)
                time = 5000;
            var n = noty({text:msg,maxVisible: 1,type:op,killer:true,timeout:time,layout: 'top'});

        }
});