var NuevoMovil = function(){
	return{

        init: function(){
        	
            urlNuevo = "moviles/nuevo.php";   

            $("#btnGuardar").click(function(){

                    var form = $(".form").serialize();

                    $.ajax({
                        type: 'post',
                        url: urlNuevo, 
                        data: form,           
                        dataType: 'html',
                        beforeSend: function(){
                           
                        },   
                        success: function(data) {
                            var datos = data;
                            if(datos != "OK"){
                                notificacion("error",data);      
                            }else{
                                notificacion("success", "Móvil guardado correctamente");
                                $(".form-control").val('');
                            }                         
                        },
                        error: function(a,b,c){
                            console.log(a);
                            console.log(b);
                            console.log(c);         
                        }
                    });

                });
		}
	};
}();