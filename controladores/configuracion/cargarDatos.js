var CargarDatos = {

	init: function(){

		urlObtenerDatos = "configuracion/obtenerPorId.php";

		$.ajax({
                        type: 'post',
                        url: urlObtenerDatos, 
                        data: {
                            'id': 1
                        },           
                        dataType: 'json',
                        beforeSend: function(){
                          
                            blockUI($(".main-content"));
                      
                        },   
                        success: function(data) {

                            $("#nombre").val(data.agencia[0].nombre);
                            $("#telefono").val(data.agencia[0].telefono);
                            $("#email").val(data.agencia[0].email);
                            $("#cuit").val(data.agencia[0].cuit);
                            $("#direccion").val(data.agencia[0].direccion);
                            $("#departamento").val(data.agencia[0].departamento);
                            $("#provincia").val(data.agencia[0].provincia);
                            $("#pais").val(data.agencia[0].pais);
                            $("#ciudad").val(data.agencia[0].ciudad);

                            unblockUI($(".main-content"));                     
                        },
                        error: function(a,b,c){
                            unblockUI($(".main-content"));
                            console.log(a);
                            console.log(b);
                            console.log(c);         
                        }


                    });

	}
}