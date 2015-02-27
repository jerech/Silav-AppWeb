var CargarPasajesEnCurso = {

	var urlObtenerPasajesEnCurso = "../Pasajes/obtenerPasajesEnCurso.php";

	init: function(){
			
			var temporizador=setInterval(function(){
			
			$.ajax({
                        type: 'post',
                        url: urlObtenerPasajesEnCurso, 
                        data: {},           
                        dataType: 'json',
                        beforeSend: function(){
                           
                        },   
                        success: function(data) {
								
								$(data.pasajes).each(function(index){
                        	/*<tr>
                    <td>

                    </td>
                    <td></td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>             */  
                        });
                                                     
                        },
                        error: function(a,b,c){

                            console.log(a);
                            console.log(b);
                            console.log(c);         
                        }


                    });
			
		},5000);
	}
}