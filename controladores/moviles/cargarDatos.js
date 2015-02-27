var CargarDatos = {

	init: function(){

		urlObtenerDatos = "moviles/obtenerPorId.php";

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

                            $("#numero").val(data.moviles[0].numero);
                            $("#patente").val(data.moviles[0].patente);
                            $("#marca").val(data.moviles[0].marca);
                            $("#modelo").val(data.moviles[0].modelo);
                            $("#vencseguro").val(data.moviles[0].vencseguro);

                            if(data.moviles[0].aa == "0"){
                            	
                                $("[name='aa']").bootstrapSwitch("state", false);
                            }
									if(data.moviles[0].gnc == "1"){

                                $("[name='gnc']").bootstrapSwitch("state", true);
                            }

                                                     
                        },
                        error: function(a,b,c){
                            console.log(a);
                            console.log(b);
                            console.log(c);         
                        }


                    });

	}
}