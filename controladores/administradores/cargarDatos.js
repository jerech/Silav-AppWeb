var CargarDatos = {

	init: function(){

		urlObtenerDatos = "administradores/obtenerPorId.php";

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

                            $("#nombre").val(data.administradores[0].nombre);
                            $("#apellido").val(data.administradores[0].apellido);
                            $("#usuario").val(data.administradores[0].usuario);
                            $("#telefono").val(data.administradores[0].telefono);
                            $("#email").val(data.administradores[0].email);
                            $("#direccion").val(data.administradores[0].direccion);
                            if(data.administradores[0].activo == "0"){
                                $("[name='activo']").bootstrapSwitch('setState','');
                            }


                            cargarPermisos(data.permisos);
                                                     
                        },
                        error: function(a,b,c){
                            console.log(a);
                            console.log(b);
                            console.log(c);         
                        }


                    });
        cargarPermisos = function(permisos){
            for(i=0;i<permisos.length;i++){
                $('#'+permisos[i].Secciones_id).prop("checked","checked");
            }
            $(".control").show();
        }
	}
}