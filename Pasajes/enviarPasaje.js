var EnviarPasaje = {

	init: function(){
			
			$("#btnAsignar").click(function(){
				
			urlpasajeGCM = "../Pasajes/pasajeGCM.php";
			
			var form = $(".form").serialize();

		$.ajax({
                        type: 'post',
                        url: urlpasajeGCM, 
                        data: form,           
                        dataType: 'json',
                        beforeSend: function(){
                           
                        },   
                        success: function(data) {
								
                                                     
                        },
                        error: function(a,b,c){

                            console.log(a);
                            console.log(b);
                            console.log(c);         
                        }


                    });
			});
	}
}