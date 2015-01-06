var NuevoAdministrador = function(){
	return{

		init: function(){

			urlSecciones = "secciones/obtenerTodas.php";

			$.ajax({
					type: 'post',
                    url: urlSecciones, 
                    data: {},           
                    dataType: 'json',
                    beforeSend: function(){
                        $("#secciones").text("");
                    },   
                    success: function(data) {
                    	var htmlPermisos = "";
                    	$(data.secciones).each(function(index){
                    		if(parseInt(data.secciones[index].idPadre) === 0){
                    			htmlPermisos += '<div class="row">';        			
                    			htmlPermisos += '<div class="col-md-4">';
                    			htmlPermisos += '<label><b>';
                    			htmlPermisos += data.secciones[index].nombre;
                    			htmlPermisos += '</b></label>';
                    			htmlPermisos += '</div>';
                    			htmlPermisos += '<div class="col-md-4">'
                    			htmlPermisos += '<input type="checkbox" checked id="'+data.secciones[index].id+'" name="permisos">';
                    			htmlPermisos += '</div>';
                    		

                    		}else{
                    			htmlPermisos += '<div class="row">'; 
                    			htmlPermisos += '<div class="col-md-4">';
                    			htmlPermisos += '<label>';
                    			htmlPermisos += data.secciones[index].nombre+":";
                    			htmlPermisos += '</label>';
                    			htmlPermisos += '<input type="checkbox" name="subpermisos">';
                    			htmlPermisos += '</div>';
                    			htmlPermisos += '<div class="col-md-4"></div>';
                    			htmlPermisos += '</div>';

                    		}
                    		
                    		htmlPermisos += '</div>';
                    		htmlPermisos += '<br>';
                    		

                    	});
                        $("#secciones").html(htmlPermisos);	 
                        $("[name=permisos]").bootstrapSwitch();           	            			
                    },
                    error: function(a,b,c){
                        console.log(a);
                        console.log(b);
                        console.log(c);  		
                    }

				});

		}
	};
}();